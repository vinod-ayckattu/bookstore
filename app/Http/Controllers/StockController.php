<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Book;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct() {

        if(!session('publisher')) {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Book $book)
    {
        if ($request->user()->cannot('view', $book)) {
            abort(403);
        }
        $publisher = \App\Models\Publisher::where('user_id', auth()->user()->id)->first();
        return view('stock.create', ['publisher' => $publisher, 'book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        if ($request->user()->cannot('view', $book)) {
            abort(403);
        }

        $request->validate(['stock' => 'required|integer|min:1|max:1000']);

        $book->stocks()->create([
            'stock' => $request['stock'],
            'stock_status' => 'Requested',
            'requested_on' => now()
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Stock request has been placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }

    public function myrequests()
    {
        $publisher = \App\Models\Publisher::where('user_id', auth()->user()->id)->first();
        $stocks = Stock::selectRaw('books.name, books.author, stocks.*')
                        ->join('books', 'books.id', '=', 'stocks.book_id')
                        ->where('books.publisher_id', $publisher->id)->orderBy('stocks.requested_on', 'desc')->get();

        return view('publisher.stockrequests', ['stocks' => $stocks, 'publisher' => $publisher]);
    }
}
