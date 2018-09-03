<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatchCable extends Model
{
  protected $fillable = ['portA_id', 'portB_id'];
    public function portA()
    {
      return  $this->belongsTo(Port::class, 'portA_id');
    }

    public function portB()
    {
      return  $this->belongsTo(Port::class, 'portB_id');
    }
}
