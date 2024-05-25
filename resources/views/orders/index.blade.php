<x-layout>
<x-navigation :links="['Home' => route('reader.books.index'), 'My Orders' => '#']" />
<div class="m-3">
    @if(count($orders))
    <div>{{ $orders->links() }}</div>
<table class="table table-striped table-bordered">
    <tr><th>SL No</th><th>Order Reference Number</th><th>Purchased Books</th><th>Placed on</th><th>Status</th><th>Final Amount</th></tr>
    @foreach($orders as $order)
        <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('order.show', $order) }}" class="text-decoration-none">{{ $order->order_ref_id }}</a></td>
        <td>
            @foreach ($order->purchasedBooks as $purchasedBook)
                <div>{{ $purchasedBook->book->name }}</div>
            @endforeach
        </td>
        <td>{{ $order->updated_at }}</td><td>{{ $order->status }}</td><td>₹{{ $order->final_amount }}</td></tr>
    @endforeach
</table>
@else
    <x-card><h4>You don't have placed any orders! </h4></x-card>
@endif
</div>
</x-layout>
