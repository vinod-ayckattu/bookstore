<x-layout>
    <x-navigation :links="['Home' => route('reader.books.index'), 'Cart' => route('cart.index'), 'Stock Status' => '#']" />
    <h5 class="text-danger m-3">The following items in your cart is not in sufficient stock for the requested quantity</h5>
    <table class="table table-bordered text-center table-striped">
        <tr><th>Sl No</th><th>Book Name</th><th>Requested Quantity</th><th>Available Stock</th><th colspan="2">Possible Actions</th></tr>
        @foreach ($purchased_books as $purchased_book)
            <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('reader.books.show',$purchased_book->book) }}" class="text-decoration-none">{{ $purchased_book->book->name }}</a></td>
                <td>{{ $purchased_book->quantity }}</td><td>{{ $purchased_book->book->stock }}</td>
                @if ($purchased_book->book->stock > 0)
                <td><form action="{{ route('cart.update', $purchased_book) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-primary cart-font text-white rounded-5">Add existing stock ( {{ $purchased_book->book->stock }} {{ Str::of('Book')->plural($purchased_book->book->stock) }} ) to Cart</button>
                </form></td>
                @endif
                <td @if($purchased_book->book->stock >= 0) colspan="2" @endif >
                    <form action="{{ route('cart.destroy', $purchased_book) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-5 btn btn-sm btn-warning cart-font text-center">Remove from Cart</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-layout>
