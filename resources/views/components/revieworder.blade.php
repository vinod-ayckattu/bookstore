
<div class="row m-3">
    <div class="col-sm-4">
        {{ $slot }}
    </div>
    <div class="col">
            <h4 class="mb-3">Order Summary</h4>
            <table class="table cart-font">
                <tr><th>Sl No</th><th>Book Name</th><th>Rate</th><th>Tax ({{ $info['order']->tax_percentage }}%)</th><th>Unit Price (Including Tax)</th><th>Quantity</th><th>Total Price (₹)</th></tr>
                @foreach ($info['books'] as $cart)
                    <tr><td>{{$loop->index+1 }}</td><td><a href="{{ route('reader.books.show', $cart->book) }}" class="text-decoration-none">{{ $cart->book->name }}</a></td><td>{{ number_format($cart->offered_rate, 2) }}</td><td>{{ number_format($cart->offered_rate*$info['order']->tax_percentage/100, 2) }}</td><td>{{ number_format($cart->offered_rate + $cart->offered_rate*$info['order']->tax_percentage/100,2) }}</td><td>{{ $cart->quantity }}</td><td>{{ number_format($cart->quantity*($cart->offered_rate + $cart->offered_rate*$info['order']->tax_percentage/100), 2) }}</td></tr>
                @endforeach
                <tr><td></td><th>Total</th><th></th><th></th><th></th><th>{{ session('cart') }}</th><th>{{ number_format($info['totalPrice']->total,2) }}</th></tr>
                <tr><td class="border-0"></td><td class="border-0">Discount ({{ $info['order']->discount_percentage }}%)</td><td class="border-0"></td><td class="border-0"></td><td class="border-0"></td><td class="border-0">-</td><td class="border-0">{{ number_format(($info['totalPrice']->total*$info['order']->discount_percentage/100), 2) }}</td></tr>
                <tr><td class="border-0"></td><th class="border-0" colspan="2"><h5>Final Amount</h5></th><td class="border-0"></td><td class="border-0"><th class="border-0">-</th><th class="border-0"><h5>₹{{ number_format($info['order']->final_amount, 2) }}</h5></th></tr>
            </table>
    </div>
</div>

