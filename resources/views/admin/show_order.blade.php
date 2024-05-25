<x-admin.layout>
    <x-navigation :links="['Home' => route('admin.index'), 'Orders' => route('admin.orders'), '#'.$order->order_ref_id => '#']" />
        <x-card>
            <div class="row">
                <div class="col">
                    <div class="mt-2"><b>Order Reference Number: </b>{{ $order->order_ref_id }}</div>
                    <div class="mt-2"><b>Customer Name: </b>{{ $order->user->name }}</div>
                    <div class="mt-2"><b>Order Status: </b>{{ $order->status }}</div>
                    <div class="mt-2"><b>Total Quantity: </b>{{ $bookCount }}</div>
                    <div class="mt-2"><b>Final Amount: </b>₹{{ $order->final_amount }}</div>
                    <div class="mt-3"><b>Order Track:</b>
                        <table class="table table-bordered table-striped mt-2">
                            <tr><th>Status</th><th>Updated On</th></tr>
                            <tr><td>Placed On</td><td>{{ $order->placed_on }}</td></tr>
                            <tr><td>Packed On</td><td>{{ $order->packed_on ?? '-' }}</td></tr>
                            <tr><td>Shipped On</td><td>{{ $order->shipped_on ?? '-' }}</td></tr>
                            <tr><td>Delivered On</td><td>{{ $order->delivered_on ?? '-'  }}</td></tr>
                        </table>
                    </div>
                    <div class="mt-2">
                        @if($order->status != 'Delivered')
                        <form action="{{ route('admin.order.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col float-start">
                                    <button class="btn btn-sm btn-primary">Update Order Status to Next Level → {{ $nextStatus }}</button>
                                </div>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2">
                        <b>Billing Address:</b>
                        <div>{{ $order->billing_address }}</div>
                    </div>
                    <div class="mt-2">
                    <b>Shipping Address:</b>
                        <div>{{ $order->shipping_address }}</div>
                    </div>
                </div>
            </div>
            <h5 class="mt-3">Books included in the Order</h5>
            <table class="table table-bordered table-striped">
                <tr><th>Sl No</th><th>Book Title</th><th>Publisher</th><th>Sold Price (₹)</th><th>Quantity</th></tr>
                @foreach ($order->purchasedBooks as $book)
                <tr><td>{{ $loop->index+1 }}</td><td>{{ $book->book->name }}</td><td>{{ $book->book->publisher->publisher_name }}</td><td>{{ $book->offered_rate }}</td><td>{{ $book->quantity }}</td></tr>
                @endforeach
            </table>
        </x-card>
</x-publisher.layout>
