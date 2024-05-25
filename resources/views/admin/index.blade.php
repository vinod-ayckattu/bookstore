<x-admin.layout>
    <x-navigation :links="[]" />
    <div class="m-3">
    <div class="cart-font">
        <x-card>
        <form action="{{ route('admin.index') }}">
        <div class="row">
            <div class="col m-2">
                <label for="publisher" class="form-label fw-bold">Publisher</label>
                <select class="form-select form-select-sm" name="publisher" id="publisher">
                    <option value="">All</option>
                    @foreach($publishers as $publisher)
                        <option value="{{$publisher->id}}" @selected( request('publisher') == $publisher->id )>{{$publisher->publisher_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col m-2">
                <label for="language" class="form-label fw-bold">Language</label>
                <select class="form-select form-select-sm" name="language" id="language">
                    <option value="">All</option>
                    @foreach($languages as $language)
                        <option value="{{$language}}" @selected( request('language') == $language )>{{$language}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col m-2">
                <label for="category" class="form-label fw-bold">Category</label>
                <select class="form-select form-select-sm" name="category" id="category">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        <option value="{{$category}}" @selected( request('category') == $category )>{{$category}}</option>
                    @endforeach
                </select>
            </div>
        </div>
            <div class="row">
                <div class="col m-2">
                <label for="search" class="form-label fw-bold">Sort By Sales</label>
                <select  class="form-select form-select-sm" name="sort_sales" id="sort_sales">
                    <option value="">None</option>
                    <option value="asc" @selected( request('sort_sales') == 'asc' )>Low to High</option>
                    <option value="desc" @selected( request('sort_sales') == 'desc' )>High to Low</option>
                </select>
                </div>
                <div class="col-8 m-2">
                    <label for="search" class="form-label fw-bold">Search</label>
                    <input type="search" name="search" id="name" value="{{request('search')}}" placeholder="Search Books, Authors...." class="form-control">
                </div>
            </div>
        <div class="row">
            <div class="col d-grid gap-2 mt-2">
                <button class="btn btn-success text-white">Filter</button>
            </div>
        </div>
        </form>
        </x-card>
    </div>
    @if(count($books) > 0)
        <div>{{ $books->links() }}</div>
        <table class="table table-striped table-bordered cart-font">
            <tr><th>Sl No</th><th>Book Name</th><th>Publisher</th><th>Author</th><th>Category</th><th>Language</th><th>Price (₹)</th><th>Sold</th><th>Balance Stock</th></tr>
            @foreach ($books as $book)
             <tr><td>{{ $loop->index+1 }}</td><td><a href="{{ route('admin.book.show', $book) }}" class="text-decoration-none">{{ $book->name }}</a></td>
             <td>{{ $book->publisher->publisher_name }}</td><td>{{ $book->author }}</td><td>{{ $book->category }}</td><td>{{ $book->language }}</td><td>{{ number_format($book->price, 2) }}</td><td>{{ $book->total ?? 0 }}</td><td>{{ $book->stock }}</td>
             </tr>
            @endforeach
        </table>
        <div>{{ $books->links() }}</div>
        </div>
    @else
        <x-card>
            <h5>Sorry! No Books found with the search criterias!</h5>
        </x-card>
    @endif
</x-publisher.layout>
