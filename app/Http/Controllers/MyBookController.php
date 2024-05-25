<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MyBookController extends Controller
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
        //$publisher = Publisher::where('user_id', auth()->user()->id)->with('books.purchasedBooks')->withCount('')->first();
        $publisher = Publisher::find(session('publisher'));
        $books = Book::selectRaw('books.*, SUM(purchased_books.quantity) as total')
                ->leftJoin('purchased_books', function ($join){
                    $join->on('purchased_books.book_id', '=','books.id')
                    ->where('purchased_books.order_placed','1');
                })->where('publisher_id', $publisher->id)->groupBy('books.id')->get();

        return view('publisher.index', ['publisher' => $publisher, 'books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publisher = Publisher::where('user_id', auth()->user()->id)->first();
        return view('publisher.create', ['publisher' => $publisher, 'categories' => Book::$categories, 'languages' => Book::$languages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => ['required', Rule::in(Book::$categories)],
            'language' => ['required', Rule::in(Book::$languages)],
            'price' => 'required|numeric|min:1|max:100000',
            'permission' => ['required', Rule::in([1,0])],
            'description' => 'required|string|max:1024'
        ],[],[
            'name' => 'Book Title',
            'author' => 'Author Name',
            'category' => 'Category',
            'language' => 'Language',
            'price' => 'Price',
            'permission' => 'Permission',
            'description' => 'Description'
        ]);
        $publisher = Publisher::where('user_id', auth()->user()->id)->first();

        $book = $publisher->books()->create([
            'name' => ucfirst($request['name']),
            'author' => ucwords($request['author']),
            'category' => $request['category'],
            'language' => $request['language'],
            'price' => $request['price'],
            'description' => $request['description'],
            'publisher_permission' => $request['permission']
        ]);

        if($book)
        {
            return redirect()->route('books.index')->with('success', 'New Book has been added to Book Store successfully!');
        }
        else
        {
            return redirect()->route('books.index')->with('failure', 'Sorry! Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Book $book)
    {

        if ($request->user()->cannot('view', $book)) {
            abort(403);
        }
        $publisher = Publisher::where('user_id', auth()->user()->id)->first();
        return view('publisher.show', ['publisher' => $publisher, 'book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Book $book)
    {
        if ($request->user()->cannot('view', $book)) {
            abort(403);
        }
        $publisher = Publisher::where('user_id', auth()->user()->id)->first();
        return view('publisher.confirmstop', ['publisher' => $publisher, 'book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if ($request->user()->cannot('view', $book)) {
            abort(403);
        }

        if($book->publisher_permission)
            $book->publisher_permission = 0;
        else
            $book->publisher_permission = 1;

        $book->save();
        return redirect()->route('books.show', $book);
    }
}
