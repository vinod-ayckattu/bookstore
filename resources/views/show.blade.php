<x-layout>
    <x-navigation :links="['Home' => route('reader.books.index'), $book->name => '#']" />
    <x-card>
        <div class="row">
            <h4 class="col-sm-10">{{ $book->name }}
            </h4>
            <h5 class="col-sm-2">₹ {{ $book->price }}</h5>
        </div>
        <div class="row">
            <b class="col-sm-10">Author: {{ $book->author }}</b>
            <div class="col-sm-2">
                @if ($cart_status)
                    <button class="rounded-5 btn btn-sm btn-success cart-font text-white text-center">In Cart</button>
                @else
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button class="rounded-5 btn btn-sm btn-primary cart-font text-white text-center">Add to Cart</button>
                    </form>
                @endif
            </div>
        </div>
        <p><span><b>Language: </b>{{ $book->language }}</span><span class="ms-5"><b>Category: </b>{{ $book->category }}</span><span class="ms-5"><b>Publisher: </b>{{ $book->publisher->publisher_name }}</span></p>
        <p>{{ $book->description }}</p>
    </x-card>
</x-layout>
