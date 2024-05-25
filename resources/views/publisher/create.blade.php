<x-publisher.layout :info="['publisher_name' => $publisher->publisher_name]">
    <x-navigation :links="['Home' => route('books.index'), 'Add New Book' => '#']" />
    <x-card>
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <label for="name" class="form-label mt-4">Book Title: </label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="author" class="form-label mt-4">Author Name: </label>
            <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}">
            @error('author')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div  class="row">
                <span class="col">
                    <label for="name" class="form-label mt-4">Category: </label>
                    <select class="form-control" name="category" id="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category}}" @selected( old('category') == $category )>{{$category}}</option>
                            @endforeach
                    </select>
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </span>
                <span class="col">
                    <label for="language" class="form-label mt-4">Language</label>
                        <select class="form-control" name="language" id="language">
                            <option value="">Select Language</option>
                            @foreach($languages as $language)
                                <option value="{{$language}}" @selected( old('language') == $language )>{{$language}}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                </span>
            </div>
            <div class="row">
                <span class="col">
                <label for="price" class="form-label mt-4">Price (MRP):</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>₹</b></span>
                        </div>
                        <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </span>

                <span class="col">
                    <label for="permission" class="form-label mt-4">Permission for Sale:</label>
                    <select name="permission" class="form-select" id="permission">
                        <option value="1">Permit</option>
                        <option value="0">Permit Later</option>
                    </select>
                    @error('permission')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </span>
            </div>
            <label for="description" class="form-label mt-4">A brief description of th book:</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-primary rounded-5 cart-font mt-3 float-end">Add Book to Store</button>
        </form>
        </div>
        <div class="col"></div>
        </div>
    </x-card>
</x-publisher.layout>
