<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Todo extends Model
{
    public $timestamps = false;

    protected $fillable = ['descripcion','user_id'];

    public function user(){
        return $this->belongTo(User::class);
    }
}
