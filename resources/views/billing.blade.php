<x-layout>
<x-navigation :links="['Home' => route('reader.books.index'), 'Cart' => route('cart.index'), 'Billing' => route('order.reviewOrder'), 'Change Address' => '#']" />
<x-revieworder :info="['books' => $books, 'order' =>$order, 'totalPrice' => $totalPrice]">
        <form action="{{ route('order.updateAddress', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="m-2">
                <label for="billing_address"><b>Billing Address:</b></label>
                <textarea name="billing_address" id="billing_address" cols="20" rows="5" class="form-control">{{ $order->billing_address }}</textarea>
            </div>
            <div class="m-2">
            <label for="shipping_address"><b>Shipping Address:</b></label>
                <textarea name="shipping_address" id="shipping_address" cols="20" rows="5" class="form-control">{{ $order->shipping_address }}</textarea>
            </div>
            <div class="m-2 float-end">
                <button class="btn btn-warning btn-sm rounded-5 cart-font">Update Address</button>
            </div>
        </form>
</x-revieworder>
</x-layout>
