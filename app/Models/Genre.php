<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
    ];

    public function book()
    {
        return $this->belongsToMany(Book::class,'genres_books', 'genre_id', 'book_id');
    }
}
