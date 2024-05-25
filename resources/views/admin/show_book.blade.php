<x-admin.layout>
    <x-navigation :links="['Home' => route('admin.index'), $book->publisher->publisher_name => route('admin.index', ['publisher' => $book->publisher->id]), $book->name => '#']" />
    <div class="m-5">
        @if(!$book)
            <x-card>
                <h5>Something went Wrong! Your requested is not available!</h5>
            </x-card>
        @endif
        <x-card>
            <p><h4>{{ $book->name }}</h4></p>
            <p><b>Publisher Name: </b>{{ $book->publisher->publisher_name }}
            <b class="ms-5">Available Stock: </b>{{ $book->stock }}</p>
            <p><b>Author: </b>{{ $book->author }}
            <b class="ms-5">Language: </b>{{ $book->language }}
            <b class="ms-5">Category: </b>{{ $book->category }}
            <b class="ms-5">Price: </b>₹{{ number_format($book->price, 2) }}</p>
            <p>
            <b>Publisher Permission for Sale: </b>
            @if( $book->publisher_permission )
                Permitted
            @else
                Not Permitted
            @endif
            <b class="ms-5">Administrator Permission for Sale: </b>
            @if( $book->admin_permission )
                Permitted
            @else
                Not Permitted
            @endif
            </p>
            <p><b>Description: </b>{{ $book->description }}</p>
            <div class="row">
               <span class="col">
                <form action="{{ route('admin.permission.update',['book' => $book]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="permission" value="1">
                    <button class="btn btn-sm @if($book->admin_permission) btn-danger @else btn-primary @endif text-white rounded-5">@if($book->admin_permission) Stop @else Start @endif Selling this Book</button>
                </form>
            </span>
               <span class="col-8">
                </span>
            </div>
        </x-card>
    </div>
</x-admin.layout>
