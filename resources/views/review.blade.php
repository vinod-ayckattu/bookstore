<x-layout>
<x-navigation :links="['Home' => route('reader.books.index'), 'Cart' => route('cart.index'), 'Billing' => '#']" />

    <x-revieworder :info="['books' => $books, 'order' =>$order, 'totalPrice' => $totalPrice]">
        <div class="m-2">
            <label for="billing_address"><b>Billing Address:</b></label>
            <address name="billing_address" id="billing_address">{{ $order->billing_address }}</address>
        </div>
        <div class="m-2">
        <label for="shipping_address"><b>Shipping Address:</b></label>
            <address name="shipping_address" id="shipping_address">{{ $order->shipping_address }}</address>
        </div>
        <form action="{{ route('order.changeAddress', $order) }}" method="GET">
        <div class="m-2">
            <button class="btn btn-warning btn-sm rounded-5 cart-font">Change Address</button>
        </div>
        </form>
    </x-revieworder>
        <div>
            <form action="{{ route('order.update', ['order' => $order]) }}" method="POST">
                @csrf
                @method('PUT')
                <button class="btn btn-primary cart-font rounded-5 float-end m-3 mb-5">Pay and Place Order</button>
            </form>
        </div>
</x-layout>
