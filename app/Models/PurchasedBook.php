<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchasedBook extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'book_id', 'quantity'];

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public static function updateCart()
    {
        $order = Order::getOrders('Cart');
        if(!$order)
        {
            session(['cart' => 0 ]);
        }
        else
        {
            $cart = self::where('order_id', $order->id)->groupBy('order_id')->sum('quantity');
            session(['cart' => $cart]);
        }

    }

    public static function booksInCart()
    {
        $order = Order::getOrders('Cart');
        if($order)
        {
            return self::where('order_id', $order->id)->with('book')->with('book.publisher')->get();
        }

    }

    public static function getTotal($withTax = false)
    {
        $order = Order::getOrders('Cart');
        if($order)
        {
            $totalPrice = self::selectRaw('SUM(quantity * price) as total')->join('books', 'books.id', '=', 'purchased_books.book_id')->where('order_id', $order->id)->with('book')->first();
            if($withTax)
            {
                $totalPrice->total = $totalPrice->total + $totalPrice->total*12/100;
            }
            return $totalPrice;
        }
        else
        {
            return false;
        }
    }

    public static function getMyBooks(Order $order)
    {
        return self::where('order_id', $order->id)->with('book')->with('book.publisher')->get();
    }
}
