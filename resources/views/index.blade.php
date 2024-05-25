<x-layout>
    <x-navigation :links="['Home' => route('reader.books.index')]"/>
    <x-card>
        <form action="{{ route('reader.books.index') }}">
            <div class="row">
                <div class="col-sm m-2">
                    <label for="search" class="form-label fw-bold">Search</label>
                    <input type="search" name="search" id="name" value="{{request('search')}}" placeholder="Search Books, Authors...." class="form-control">
                </div>
                <div class="col-sm m-2">
                <label for="search" class="form-label fw-bold">Sort By Price</label>
                <select  class="form-select" name="sort" id="sort">
                    <option value="">Choose an option to sort</option>
                    <option value="asc" @selected( request('sort') == 'asc' )>Low to High</option>
                    <option value="desc" @selected( request('sort') == 'desc' )>High to Low</option>
                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm m-2">
                    <label for="publisher" class="form-label fw-bold">Publisher</label>
                        <select class="form-select" name="publisher" id="publisher">
                        <option value="">All</option>
                        @foreach($publishers as $publisher)
                            <option value="{{$publisher->id}}" @selected( request('publisher') == $publisher->id )>{{$publisher->publisher_name}}</option>
                        @endforeach
                        </select>
                </div>
            <div class="col-sm m-2">
                <label for="language" class="form-label fw-bold">Language</label>
                <select class="form-select" name="language" id="language">
                    <option value="">All</option>
                    @foreach($languages as $language)
                        <option value="{{$language}}" @selected( request('language') == $language )>{{$language}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm m-2">
                <label for="category" class="form-label fw-bold">Category</label>
                <select class="form-select" name="category" id="category">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        <option value="{{$category}}" @selected( request('category') == $category )>{{$category}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col d-grid gap-2">
                <button class="btn btn-success text-white">Filter</button>
            </div>
        </div>
        </form>
    </x-card>
    @if(count($books)==0)
        <div class="text-center"><x-card><h4>Sorry! No Books found with the above search criterias</h4></x-card></div>
    @endif
    <div class="ms-4 me-4">{{ $books->links() }}</div>
@foreach($books as $book)
    <x-card>
        <div class="row"><h4 class="col-sm-10"><a class="text-decoration-none" href="{{ route('reader.books.show',['book' => $book]) }}">{{ $book->name }}</a></h4><h5 class="col-sm-2">₹ {{ number_format($book->price,2) }}</h5></div>
        <div class="row"><b class="col-sm-10">Author: {{ $book->author }}</b>
        <div class="col-sm-2">
            @forelse ($booksInCart as $bookInCart)
                @if ($bookInCart->book->id === $book->id)
                    <button class="rounded-5 btn btn-sm btn-success cart-font text-white text-center">In Cart</button>
                    @break
                @elseif ($loop->last)
                    <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button class="rounded-5 btn btn-sm btn-primary cart-font text-white text-center">Add to Cart</button>
                    </form>
                @endif
            @empty
            <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button class="rounded-5 btn btn-sm btn-primary cart-font text-white text-center">Add to Cart</button>
                    </form>
            @endforelse
        </div></div>
        <p><span><b>Language: </b>{{ $book->language }}</span><span class="ms-5"><b>Category: </b>{{ $book->category }}</span><span class="ms-5"><b>Publisher: </b>{{ $book->publisher->publisher_name }}</span></p>
        <p>{{ $book->description}}</p>
    </x-card>
@endforeach
<div class="ms-4 me-4">{{ $books->links() }}</div>
</x-layout>
