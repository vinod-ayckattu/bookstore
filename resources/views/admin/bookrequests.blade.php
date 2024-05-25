<x-admin.layout>
    <x-navigation :links="['Home' => route('admin.index'), 'New Book Requests' => '#']" />
    <div class="m-5 cart-font">
        <h3 class="ms-4">New Book Requests</h3>
        @session('success')
            <div class="text-success fw-bold text-center">{{ $value }}</div>
        @endsession
        @if(count($books) == 0)
            <x-card>
                <h5>No New Book Requests Received!</h5>
            </x-card>
        @endif
        @foreach ($books as $book)
        <x-card>
            <p><h5>{{ $book->name }}</h5></p>
            <p><b>Publisher Name: </b>{{ $book->publisher->publisher_name }}
            <b class="ms-5">Author: </b>{{ $book->author }}
            <b class="ms-5">Language: </b>{{ $book->language }}
            <b class="ms-5">Category: </b>{{ $book->category }}</p>
            <p><b>Price: </b>₹{{ number_format($book->price, 2) }}
            <b class="ms-5">Publisher Permission for Sale: </b>
            @if( $book->publisher_permission )
                Permitted
            @else
                Not Permitted
            @endif
            </p>
            <p><b>Description: </b>{{ $book->description }}</p>
            <div class="row">
               <span class="col">
                <form action="{{ route('admin.permission.update',['book' => $book]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="permission" value="1">
                    <button class="btn btn-sm btn-primary text-white">Approve this Book for Sale</button>
                </form>
            </span>
               <span class="col-8">
                    <form action="{{ route('admin.permission.update',['book' => $book]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="permission" value="0">
                        <button class="btn btn-sm btn-danger text-white">
                            Don't Permit for Sale
                        </button>
                    </form>
                </span>
            </div>
        </x-card>
        @endforeach
    </div>
</x-admin.layout>
