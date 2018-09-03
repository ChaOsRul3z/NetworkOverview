<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    protected $fillable = ['name', 'paths'];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}
