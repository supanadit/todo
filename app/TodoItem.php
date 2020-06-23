<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    public function todo()
    {
        return $this->hasOne('App\Todo');
    }
}
