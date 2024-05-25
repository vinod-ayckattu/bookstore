<x-layout>
<x-navigation :links="['Home' => route('reader.books.index'), 'Cart' => '#']" />
@if(session('cart') == 0)
    <x-cart-item>
        <h3>Your Book Cart is empty!</h3>
        <h6 class="mt-3">You can add books to your cart <a href="{{ route('reader.books.index') }}">here</a></h6>
    </x-cart-item>
@else
    <div class="d-flex justify-content-end me-5  mb-3">
        <form action="{{ route('order.reviewOrder') }}" method="GET">
              <button class="btn btn-primary rounded-5 cart-font">Proceed to Buy →</button>
        </form>
    </div>
    <div class="d-flex justify-content-end me-5"><h5>Total Price: ₹ {{ number_format($totalPrice->total,2) }}</h5></div>
    @foreach($books as $cart_item)
        <x-cart-item>
            <div class="row"><h4 class="col-sm-10"><a class="text-decoration-none" href="{{ route('reader.books.show',['book' => $cart_item->book]) }}">{{ $cart_item->book->name }}</a></h4><h5 class="col-sm-2">₹ {{ number_format($cart_item->book->price,2) }}</h5></div>
            <div class="row"><b class="col-sm-10">Author: {{ $cart_item->book->author }}</b>
            <div class="col-sm-2">
            <form action="{{ route('cart.destroy', $cart_item) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="return_to" value="cart">
                <button class="rounded-5 btn btn-sm btn-warning cart-font text-center">Remove from Cart</button>
            </form>
            </div></div>
            <p class="mt-3"><span><b>Language: </b>{{ $cart_item->book->language }}</span><span class="ms-5"><b>Category: </b>{{ $cart_item->book->category }}</span><span class="ms-5"><b>Publisher: </b>{{ $cart_item->book->publisher->publisher_name }}</span>

                @if ($cart_item->book->stock > 0)
                    <span class="col text-success ms-3"><b>In Stock</b></span></p>
                    <div class="row">
                        <form action="{{ route('cart.update', $cart_item) }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <span class="col-sm-2 float-start">
                                    <b>Quantity Required:</b>
                            </span>
                            <span class="col-sm-1 float-start">
                                    <input type="number" name="quantity" value="{{$cart_item->quantity}}" min="1" class="form-control">
                                </span>
                                <span class="col-sm-1 float-start ms-2">
                                <input type="hidden" name="book_id" id="book_id" value="{{ $cart_item->book->id }}">
                                    <button class="btn btn-sm btn-warning rounded-5 ">Update</button>
                                </span>
                            <span class="col-sm-8 text-danger">
                                @if(old('book_id') == $cart_item->book->id)
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                @endif
                                </span>
                        </form>
                    </div>
                @else
                    <span class="col-2 text-danger ms-3"><b>Out of Stock</b></span>
                @endif
        </x-cart-item>
    @endforeach
@endif
</x-layout>
