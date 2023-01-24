<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function book(){
        return $this->belongsToMany(Book::class, 'book_groups', 'groupId', 'bookId');
    }
}
