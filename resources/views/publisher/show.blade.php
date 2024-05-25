<x-publisher.layout :info="['publisher_name' => $publisher->publisher_name]">
    <x-navigation :links="['Home' => route('books.index'), $book->name => '#']" />
    <div class="m-5">
        @session('success')
            <div class="text-success fw-bold text-center">{{ $value }}</div>
        @endsession
        <x-card>
            <p><h5>{{ $book->name }}</h5></p>
            <p><b>Author: </b>{{ $book->author }}
            <b class="ms-5">Language: </b>{{ $book->language }}
            <b class="ms-5">Category: </b>{{ $book->category }}</p>
            <p><b>Price: </b>₹{{ $book->price }}
            <b class="ms-5">Current Stock: </b>{{ $book->stock }}
            <b class="ms-5">Permission for Sale: </b>
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
               <span class="col"><form action="{{ route('books.stocks.create',['book' => $book]) }}"><button class="btn btn-sm btn-success text-white cart-font rounded-5">Add Stock</button></form></span>
               <span class="col-10">
                    <form action="{{ route('books.edit',['book' => $book]) }}">
                        <button class="btn btn-sm @if($book->publisher_permission) btn-danger @else btn-success @endif text-white cart-font rounded-5">
                            @if($book->publisher_permission) Stop @else Permit @endif Selling
                        </button>
                    </form>
                </span>
            </div>
        </x-card>
    </div>
</x-publisher.layout>
