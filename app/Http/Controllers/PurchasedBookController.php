<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PurchasedBook;
use Illuminate\Http\Request;

class PurchasedBookController extends Controller
{
    public function __construct() {
        if(session('publisher') || session('admin')) {
            abort(403);
        }
    }
    public function index()
    {
        $books = PurchasedBook::booksInCart();
        $totalPrice = PurchasedBook::getTotal();

        return view('cart', ['books' => $books, 'totalPrice' => $totalPrice]);
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
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchasedBook $cart)
    {
        $reviewOrder = false;
        if(request('quantity') || request('book_id'))
        {
            $request->validate( ['quantity' => 'required|integer|min:1|max:'.$cart->book->stock],
                                ['quantity.max' => 'Available stock is :max.'],
                                ['quantity' => 'Quantity']);

            $quantity = $request['quantity'];
        }
        else
        {
            $quantity = $cart->book->stock;
            $reviewOrder = true;
        }
        $cart->update(['quantity' => $quantity]);

        PurchasedBook::updateCart();
        if($reviewOrder)
        {
            return redirect()->route('order.reviewOrder');
        }
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, PurchasedBook $cart)
    {
        $cart->delete();
        PurchasedBook::updateCart();
        if(isset($request['return_to']))
        {
            return redirect()->route('cart.index');
        }

        return redirect()->route('order.reviewOrder');
    }

    public function outofStock(array $purchased_books)
    {
        return view('outofstock', ['purchased_books'=> $purchased_books]);
    }
}
