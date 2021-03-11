<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // one to many
    // masing-masing order hanya bisa dimiliki oleh model User saja belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // many to many
    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('quantity');
    }



    // dynamic property
    // mengambil quantity di tabel pivot
    public function getTotalQuantityAttribute()
    {
        $total_quantity = 0;

        foreach ($this->books as $book) {

            $total_quantity += $book->pivot->quantity;
        }

        return $total_quantity;
    }
}
