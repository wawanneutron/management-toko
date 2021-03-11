<?php

namespace App;

use App\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function Orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
