<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public function todoItems()
    {
        return $this->hasMany('App\TodoItem');
    }
}
