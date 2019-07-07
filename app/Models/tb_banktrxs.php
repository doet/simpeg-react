<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tb_banktrxs extends Model
{
    public function user()
    {
      return $this->belongsTo('App\Models\members');
    }
}
