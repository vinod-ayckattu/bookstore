<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PurchasedBook;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->where('status','!=','Cart')
                    ->orderBy('placed_on', 'desc')->paginate(15);
        return view('orders.index', ['orders'=> $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $order = Order::getOrders('Cart');
        if(!$order) {
            return redirect()->route('cart.index');
        }
        $stockStatus = $this->verifyStock($order);
        if($stockStatus === true)
        {
            $totalPrice = PurchasedBook::getTotal(true);
            $order->tax_percentage = 12;
            $order->discount_percentage = 2.5;
            $order->final_amount = number_format($totalPrice->total - ($totalPrice->total * $order->discount_percentage / 100), 2,'.','');
            if(is_null($order->billing_address))
            {
                $order->billing_address = auth()->user()->address;
                $order->shipping_address = auth()->user()->address;
            }

            $order->save();
            $order->refresh();
            $books = PurchasedBook::booksInCart();
            foreach($books as $book)
            {
                $book->offered_rate = $book->book->price;
                $book->save();
            }

            if ($request->routeIs('order.reviewOrder')) {

                return view('review', ['books' => $books, 'order' =>$order, 'totalPrice' => $totalPrice]);
            }
            return view('billing', ['books' => $books, 'order' =>$order, 'totalPrice' => $totalPrice]);
        }
        else
        {
            return view('outofstock', ['purchased_books'=> $stockStatus]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $query = Order::query();
        $order = Order::getOrders('Cart');

        if(!$order)
        {
            $order = Order::create([
                    'user_id' => $request->user()->id,
                    'status' => 'Cart'
                    ]);
        }

        PurchasedBook::create([
            'order_id' => $order->id,
            'book_id' => request('book_id'),
            'quantity' => 1
        ]);

        PurchasedBook::updateCart();

        return redirect()->route('reader.books.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //$books = PurchasedBook::getMyBooks($order);
        $order = $order->where('id',$order->id)->with('purchasedBooks.book.publisher')->first();
       //$order->load('book')
        return view('orders.show', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $stockStatus = $this->verifyStock($order);
        if($stockStatus === true)
        {
            foreach($order->purchasedBooks as $purchasedBook)
            {
                $purchasedBook->book->stock = $purchasedBook->book->stock - $purchasedBook->quantity;
                $purchasedBook->order_placed = 1;
            }
            $order->order_ref_id = $order->id.'-'.$order->user_id.'-'.date_format(date_create(), 'Hisu');
            $order->status = 'Placed';
            $order->placed_on = now();
            $order->push();
            PurchasedBook::updateCart();
            return redirect()->route('order.show',['order' => $order])->with('success', 'Your Order has been placed successfully!');
        }
        else
        {
            return view('outofstock', ['purchased_books'=> $stockStatus]);
        }
    }

    public function updateAddress(Request $request, Order $order)
    {
        $request->validate([
            'billing_address' => 'required',
            'shipping_address' => 'required'
        ]);

        $order->billing_address = $request->input('billing_address');
        $order->shipping_address = $request->input('shipping_address');

        $order->save();
        $order->refresh();
        return redirect()->route('order.reviewOrder');
    }


    public function verifyStock(Order $order)
    {
        $books_outofstock = [];
        $flag = true;
        foreach($order->purchasedBooks as $purchasedBook)
        {
            if($purchasedBook->quantity > $purchasedBook->book->stock)
            {
                array_push($books_outofstock, $purchasedBook);
            }
        }
        if(empty($books_outofstock))
            return true;
        else
            return $books_outofstock;
        //redirect()->route('cart.outofstock', ['purchased_books' => $books_outofstock]);
    }

}
