<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;

    public $timestamps = false;
    //
    protected $fillable = ['nombre','cedula','email','password'];

    protected $hidden = ['password'];
    protected $casts = ['password'=>'hashed'];

}
