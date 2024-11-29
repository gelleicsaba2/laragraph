<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'login_sessions';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
