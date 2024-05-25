<x-publisher.layout :info="['publisher_name' => $publisher->publisher_name]">
    <x-navigation :links="['Home' => route('books.index'), $book->name => '#']" />
    <div class="m-5">
        @session('success')
            <div class="text-success fw-bold text-center">{{ $value }}</div>
        @endsession
        <x-card>
                <div>Are you sure want to
                        @if($book->publisher_permission)
                            temperorily stop
                        @else
                            start
                        @endif
                        selling of your book <b>'{{ strtoupper($book->name)}}' </b>?</div>
                <div class="row m-3">
                    <div class="col text-end">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-primary">Yes</button>
                    </form>
                    </div>
                    <div class="col float-start ms-2">
                        <a href="{{ route('books.show', $book) }}" class="text-decoration-none"><button class="btn btn-primary">No</button></a>
                    </div>
                </div>
        </x-card>
    </div>
</x-publisher.layout>
