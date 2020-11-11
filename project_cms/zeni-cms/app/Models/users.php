<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class users extends Model
{
    use SoftDeletes;
    protected $table = "users";
    protected $fillable = ['name', 'email', 'password', 'role', 'remember_token'];
}
