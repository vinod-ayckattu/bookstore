<x-admin.layout>
    <x-navigation :links="['Home' => route('admin.index'), 'Orders' => '#']" />
    <div class="m-3">
    <div class="cart-font">
        <x-card>
        <form action="{{ route('admin.orders') }}">
            <div class="row">
                <div class="col m-2">
                <label for="search" class="form-label fw-bold">Order Status</label>
                <select  class="form-select" name="status" id="status">
                    <option value="">All</option>
                    <option value="Placed" @selected( request('sort_sales') == 'Placed' )>Placed</option>
                    <option value="Packed" @selected( request('sort_sales') == 'Packed' )>Packed</option>
                    <option value="Shipped" @selected( request('sort_sales') == 'Shipped' )>Shipped</option>
                    <option value="Delivered" @selected( request('sort_sales') == 'Delivered' )>Delivered</option>
                </select>
                </div>
                <div class="col-8 m-2">
                    <label for="order_ref_id" class="form-label fw-bold">Search with Order Reference Number</label>
                    <input type="search" name="order_ref_id" id="order_ref_id" value="{{request('order_ref_id')}}" placeholder="Order #" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col d-grid gap-2 mt-2">
                    <button class="btn btn-success text-white">Search</button>
                </div>
            </div>
        </form>
        </x-card>
    </div>
    @if(count($orders) > 0)
        <div>{{ $orders->links() }}</div>
        <table class="table table-striped table-bordered cart-font">
            <tr><th>Sl No</th><th>Order Reference Number</th><th>Customer Name</th><th>Placed On</th><th>Status</th></tr>
            @foreach ($orders as $order)
             <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('admin.order.show', $order) }}" class="text-decoration-none">{{ $order->order_ref_id }}</a></td>
             <td>{{ $order->user->name }}</td><td>{{ $order->placed_on }}</td><td>{{ $order->status }}</td>
             </tr>
            @endforeach
        </table>
        <div>{{ $orders->links() }}</div>
        </div>
    @else
        <x-card>
            <h5>Sorry! No Orders found with the search criterias!</h5>
        </x-card>
    @endif
</x-publisher.layout>
