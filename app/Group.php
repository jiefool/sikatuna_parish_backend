<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function services()
    {
        return $this->hasMany('App\GroupService');
    }
}
