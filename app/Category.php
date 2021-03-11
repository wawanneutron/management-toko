<?php

namespace App;

use App\Book;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function Books()
    {
        return $this->belongsToMany(Book::class);
    }
}
