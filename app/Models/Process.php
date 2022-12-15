<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function reg(){
        return $this->hasOne(Headtype::class);
    }
}
