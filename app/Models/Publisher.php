<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Publisher extends Model
{
    use HasFactory;

    public function books() : HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function user() : HasOne
    {
        return $this->hasOne(User::class);
    }
}
