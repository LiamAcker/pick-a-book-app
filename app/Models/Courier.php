<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    public function orderHeader(){
        return $this->hasMany(orderHeader::class, 'courierId', 'id');
    }
}
