<form action="{{ route('order.update', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="m-2">
                <label for="billing_address"><b>Billing Address:</b></label>
                <textarea name="billing_address" id="billing_address" cols="30" rows="7" class="form-control">{{ auth()->user()->address }}</textarea>
            </div>
            <div class="m-2">
            <label for="shipping_address"><b>Shipping Address:</b></label>
                <textarea name="shipping_address" id="shipping_address" cols="30" rows="7" class="form-control">{{ auth()->user()->address }}</textarea>
            </div>
            <div class="m-2 float-end">
                <button class="btn btn-primary rounded-5 cart-font">Update and Place Order</button>
            </div>
        </form>
