<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Stock;
use App\Models\Order;
use App\Models\PurchasedBook;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct() {

        if(!session('admin')) {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book_query = Book::query();

        $book_query->when(request('search'), function ($query){
            $query->where(function($query){
                $query->where('name' , 'like' ,'%' . request('search') . '%')
                ->orWhere('author' , 'like' ,'%' . request('search') . '%')
                ->orWhere('description' , 'like' ,'%' . request('search') . '%');
            });
        })->when(request('language'), function ($query){
            $query->where('language' , '=' , request('language'));
        })->when(request('category'), function ($query){
            $query->where('category' , '=' , request('category'));
        })->when(request('publisher'), function ($query){
            $query->where('publisher_id' , '=' , request('publisher'));
        })->when(request('sort_sales'), function ($query){
            $query->orderBy('total', request('sort_sales'));
        });

        $books = $book_query->selectRaw('books.*, SUM(purchased_books.quantity) as total')
                    ->leftJoin('purchased_books', function ($join){
                    $join->on('purchased_books.book_id', '=','books.id')
                    ->where('purchased_books.order_placed','1');
                    })->groupBy('books.id')->with('publisher')->paginate(20);

        return view('admin.index',['books' => $books,
                            'languages' => Book::$languages,
                            'categories' => Book::$categories,
                            'publishers' => \App\Models\Publisher::all()
                        ]);
    }

    public function orders()
    {
        $order_query = Order::query();

        $order_query->when(request('status'), function($query){
            $query->where('status', '=', request('status'));
        })->when(request('order_ref_id'), function($query){
            $query->where('order_ref_id', '=', request('order_ref_id'));
        });

        $orders = $order_query->where('status', '!=', 'Cart')->with('user')->orderBy('placed_on', 'desc')->paginate(15);

        return view('admin.orders', ['orders' => $orders]);
    }

    public function showOrder(Order $order)
    {

        $nextStatus = $order->nextStatus();
        $order->load('purchasedBooks.book.publisher');
        $bookCount = PurchasedBook::where('order_id', $order->id)->sum('quantity');

        return view('admin.show_order', ['order' => $order, 'nextStatus' => $nextStatus, 'bookCount' => $bookCount]);
    }

    public function updateOrder(Order $order)
    {
            $nextStatus = $order->nextStatus();
            $field_name = strtolower($nextStatus.'_on');
            $order->status = $nextStatus;
            $order->$field_name = now();
            $order->save();

            $order->refresh();
            return redirect()->route('admin.order.show', ['order' => $order]);

    }

    public function bookRequests()
    {
        $books = Book::where('admin_permission', null)->with('publisher')->paginate(5);

        return view('admin.bookrequests', ['books' => $books]);
    }

    public function updatePermission(Request $request, Book $book)
    {
        $request->validate(['permission' => ['required', Rule::in([1,0])]]);

        $book->admin_permission = $request['permission'];
        $book->save();

        return redirect()->route('admin.bookrequests')->with('success', 'Administrator Permission updated Successfully for Book: '. strtoupper($book->name));
    }

    public function showBook(Book $book)
    {
        $book->load('publisher');

        return view('admin.show_book', ['book' => $book]);
    }

    public function stockRequests()
    {
        $stocks = Stock::where('stock_status', 'Requested')->with('book.publisher')->paginate(15);

        return view('admin.stockrequests', ['stocks'=> $stocks]);
    }

    public function stockUpdate(Request $request, Stock $stock)
    {
        $request->validate(['process' => ['required', Rule::in(['Approved', 'Rejected'])]]);
        $stock->stock_status = $request['process'];
        $stock->processed_on = now();
        if($request['process'] == 'Approved')
        {
            $stock->book->stock = $stock->book->stock + $stock->stock;
            $stock->book->save();
        }

        $stock->save();

        return redirect()->route('admin.stockrequests')->with('success', 'Stock request for the Book '.strtoupper($stock->book->name).' has been Processed!');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
