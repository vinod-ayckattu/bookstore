<x-layout>
<x-navigation :links="['Home' => route('reader.books.index'), 'My Orders' => route('order.index'), '#'.$order->order_ref_id => '#']" />
@session('success')
<div class="bg-success text-white rounded-3 border border-2 m-4 p-3">{{ $value }}</div>
@endsession
<div class="row m-3">
    <div class="col">
        <p><b>Billed Address: </b><address>{{ $order->billing_address }}</address></p>
        <p><b>Shipping Address: </b><address>{{ $order->shipping_address }}</address></p>
        <p class="mt-5"><b>Order Status</b></p>
        <table class="table table-striped table-bordered">
            <tr><td>Placed on</td><td>{{ $order->placed_on ?? '-'}}</td></tr>
            <tr><td>Packed on</td><td>{{ $order->packed_on ?? '-' }}</td></tr>
            <tr><td>Shipped on</td><td>{{ $order->shipped_on ?? '-' }}</td></tr>
            <tr><td>Delivered on</td><td>{{ $order->delivered_on ?? '-' }}</td></tr>
        </table>
        <p class="mt-5"><b>Final Amount: ₹{{ $order->final_amount }}</b></p>
    </div>
    <div class="col m-2 p-3 mb-5 rounded-2 border border-2">
        <div class="ps-4 text-success"><h5>Books purchased in this order</h5></div>
        @foreach ($order->purchasedBooks as $purchasedBook)
            <x-card>
                <div><h5><a href="{{ route('reader.books.show', $purchasedBook->book) }}" class="text-decoration-none">{{ $purchasedBook->book->name }}</a></h5></div>
                <div>{{$purchasedBook->book->language }} / {{$purchasedBook->book->author }} / {{ $purchasedBook->book->publisher->publisher_name }}</div>
                <div class="mt-3"><b><span>Price: ₹{{ $purchasedBook->offered_rate }}</span><span class="ms-3">Quantity: {{ $purchasedBook->quantity }}</span></b></div>
            </x-card>
        @endforeach
    </div>

</div>

</x-layout>
