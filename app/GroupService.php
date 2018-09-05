<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupService extends Model
{
  public function group()
  {
    return $this->belongsTo('App\Group');
  }
}
