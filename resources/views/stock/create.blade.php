<x-publisher.layout :info="['publisher_name' => $publisher->publisher_name]">
    <x-navigation :links="['Home' => route('books.index'), $book->name => route('books.show', $book), 'Add More Stock' => '#']" />
    <div class="m-5">
        <x-card>
        <p><h5>{{ $book->name }}</h5></p>
            <p><b>Author: </b>{{ $book->author }}
            <b class="ms-5">Language: </b>{{ $book->language }}
            <b class="ms-5">Category: </b>{{ $book->category }}</p>
            <p><b>Price: </b>₹ {{ $book->price }}
            <b class="ms-5">Current Stock: </b>{{ $book->stock }}
            <b class="ms-5">Publisher Permission: </b>
            @if( $book->publisher_permission )
                Permitted
            @else
                Not Permitted
            @endif
            <b class="ms-5">Administrator Permission: </b>
            @if( $book->admin_permission )
                Permitted
            @else
                Not Permitted
            @endif
            </p>
            <p><b>Description: </b>{{ $book->description }}</p>

            <div class="row">
                @if(!$book->admin_permission)
                    <div class="text-danger text-center fw-bold">You can add stock once Administrator permits sale of the book!</div>
                @else
                        <form action="{{ route('books.stocks.store', ['book' => $book]) }}" method="POST" class="form-horizontal">
                            @csrf
                            <span class="col-4 float-start">
                                    <b>Number of Books to be added</b>
                            </span>
                            <span class="col-2 float-start">
                                    <input type="number" name="stock" value="100" min="1" max="1000" class="form-control">
                                    @error('stock')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                                <span class="col-2 float-start ms-2">
                                    <button class="btn btn-sm btn-primary rounded-5 cart-font">Add to Stocks</button>
                                </span>

                            <span class="col-6"></span>
                        </form>
                @endif
            </div>
        </x-card>
    </div>
</x-publisher.layout>
