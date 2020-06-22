<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food_order extends Model
{
    public function food() {
        return $this->hasOne('App\food', 'id', 'id_food');
    }
}
