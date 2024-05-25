<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchasedBook;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'packed_on'];

    public static array $status = ['Placed', 'Packed', 'Shipped', 'Delivered'];

    public function purchasedBooks() : HasMany
    {
        return $this->hasMany(PurchasedBook::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrders($status)
    {
        return self::where('user_id', Auth::id())->where('status', $status)->first();
    }

    public function nextStatus()
    {
        if($this->status !== 'Delivered')
        {
            $counter = 0;
            foreach(self::$status as $option)
            {
                $counter++;
                if($this->status == $option)
                {
                    return self::$status[$counter];
                }
            }
        }
        return '';
    }
}
