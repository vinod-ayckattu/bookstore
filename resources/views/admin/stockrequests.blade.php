<x-admin.layout>
    <x-navigation :links="['Home' => route('admin.index'), 'Stock Requests' => '#']" />
    <div class="m-5">
        <table class="table table-bordered table-striped">
            <tr><th>Sl No</th><th>Book Title</th><th>Publisher</th><th>Existing Stock</th><th>Requested Additional Stock</th><th colspan="2">Actions</th></tr>
            @foreach ($stocks as $stock)
            <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('admin.book.show', $stock->book) }}" class="text-decoration-none">{{ $stock->book->name }}</a></td><td>{{ $stock->book->publisher->publisher_name }}</td><td>{{ $stock->book->stock }}</td><td>{{ $stock->stock }}</td>
                <td>
                        <form action="{{ route('admin.stock.update', $stock) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="Approved" name="process">
                        <button class="btn btn-sm btn-primary">Approve</button>
                        </form>
                </td>
                    <td>
                        <form action="{{ route('admin.stock.update', $stock) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="Rejected" name="process">
                        <button class="btn btn-sm btn-danger">Reject</button>
                        </form>
                </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-admin.layout>
