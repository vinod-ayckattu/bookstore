<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PurchasedBook;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author', 'language', 'category', 'price', 'stock', 'description'];

    public static array $languages = ['English','Latin','German','Malayalam','Hindi','Tamil'];
    public static array $categories = ['Biography','Fiction','Short Story','History','Literature','Academics'];

    public function publisher() : BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function purchasedBooks() : HasMany
    {
        return $this->hasMany(PurchasedBook::class);
    }
    public function stocks() : HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
