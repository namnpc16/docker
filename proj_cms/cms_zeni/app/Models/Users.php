<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Users extends Model
{
    use SoftDeletes;
    protected $table = "users";
    protected $fillable = ['name', 'email', 'password', 'role', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
        $this->attributes['remember_token'] = Str::random(60);
    }
}
