<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kullanicilar extends Model
{
    protected  $table='users';
    protected  $fillable=['username','user_title','password'];
}
