<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    protected $fillable = ['name', 'brand', 'unit_height', 'port_count'];

    public function devices() {
        return $this->hasMany(Device::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function sort()
    {
        return $this->belongsTo(Sort::class);
    }
}
