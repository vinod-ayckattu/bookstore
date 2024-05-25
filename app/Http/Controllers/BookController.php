<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\PurchasedBook;
use App\Models\Order;

class BookController extends Controller
{
    public function __construct() {
        if(session('publisher') || session('admin')) {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //  $request
        $books = Book::query();

        $books->when(request('search'), function ($query){
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
        })->when(request('sort'), function ($query){
            $query->orderBy('price', request('sort'));
        })->where('stock', '>', 0)->where('publisher_permission', 1)->where('admin_permission', 1);

        $cart = Order::getOrders('Cart');
        $booksInCart= [];
        if($cart)
        {
            $booksInCart = PurchasedBook::booksInCart();
            PurchasedBook::updateCart();
        }

        $publishers = \App\Models\Publisher::all();
        return view('index',['books' => $books->with('publisher')->Paginate(15)->withQueryString(),
                            'languages' => Book::$languages,
                            'categories' => Book::$categories,
                            'booksInCart' => $booksInCart,
                            'publishers' => $publishers
                        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart_status = false;
        $book = Book::findOrFail($id);
        $purchasedBooks = PurchasedBook::booksInCart();
        if($purchasedBooks)
        {
        foreach($purchasedBooks as $purchasedBook)
        {
            if($purchasedBook->book_id == $id)
            {
                $cart_status = true;
            }
        }
        }
        return view('show',['book' => $book, 'cart_status' => $cart_status]);
    }

}
