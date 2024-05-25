<div class="m-4">
<nav>
    <ul class="list-inline">
        @if(count($links))
            @foreach ($links as $label => $link)
                <li class="list-inline-item">@if(!$loop->first) → @endif<a class="text-decoration-none" href="{{ $link }}">{{$label}}</a></li>
            @endforeach
        @endif
    </ul>
</nav>
</div>
