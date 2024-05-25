<x-publisher.layout :info="['publisher_name' => $publisher->publisher_name]">
    <x-navigation :links="['Home' => route('books.index')]" />
    <div class="m-5">
    @session('success')
        <div class="bg-success text-white rounded-3 border border-2 m-4 p-3">{{ $value }}</div>
    @endsession
    @session('failure')
        <div class="bg-danger text-white rounded-3 border border-2 m-4 p-3">{{ $value }}</div>
    @endsession
        <div class="float-end mb-3">
        <form action="{{ route('books.create') }}">
        <button class="btn btn-primary cart-font">Add New Book</button>
        </form>
        </div>
        <table class="table table-striped table-bordered">
            <tr><th>Sl No</th><th>Book Name</th><th>Author</th><th>Category</th><th>Total Sales</th><th>Balance Stock</th></tr>
            @foreach ($books as $book)
             <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('books.show', $book) }}" class="text-decoration-none">{{ $book->name }}</a></td>
             <td>{{ $book->author }}</td><td>{{ $book->category }}</td><td>{{ $book->total ?? 0 }}</td><td>{{ $book->stock }}</td>
             </tr>
            @endforeach
        </table>
    </div>
</x-publisher.layout>
