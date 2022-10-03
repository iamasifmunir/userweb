<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public function post(){

        return $this->hasMany(Post::class,'website_id','id');
    }

    public function subscriber(){

        return $this->hasMany(Subscriber::class,'website_id','id');
    }
}
