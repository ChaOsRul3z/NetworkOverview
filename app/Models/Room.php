<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $fillable = ['name', 'number', 'paths'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function ports()
    {
        return $this->belongsToMany(Port::class);
    }
}
