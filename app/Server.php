<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    public function accounts () {
        return $this->hasMany('App\Account');
    }
}
