<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['field'];

    public function getFieldAttribute() {
        return $this->todo_start->format('Y-m-d H:i');
    }
}
