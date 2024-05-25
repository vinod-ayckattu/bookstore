<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {
        return $user->id === $book->publisher->user_id;
    }
    
    public function isPublisher(Book $book)
    {
        $publisher = \App\Models\Publisher::where('user_id', auth()-user()->id)->first();
        if($publisher)
            return true;
        else
            return false;
    }
}
