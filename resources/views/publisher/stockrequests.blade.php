<x-publisher.layout :info="['publisher_name' => $publisher->publisher_name]">
    <x-navigation :links="['Home' => route('books.index'), 'Stock Requests' => '#']" />
    @if(!$stocks)
        <x-card>
            <h4></h4>You have not made any Stock Request!!
        </x-card>
    @else
        <div class="m-5">
                <table class="table table-bordered table-striped">
                    <tr><th>Sl No</th><th>Book Title</th><th>Author</th><th>Requested Stock</th><th>Requested On</th><th>Request Status</th></tr>
                    @foreach ($stocks as $stock)
                        <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('books.show', $stock->book_id) }}" class="text-decoration-none">{{ $stock->name }}</a></td><td>{{ $stock->author }}</td><td>{{ $stock->stock }}</td><td>{{ $stock->requested_on }}</td><td>{{ $stock->stock_status }}</td></tr>
                    @endforeach
                </table>
        </div>
    @endif
</x-publisher.layout>
