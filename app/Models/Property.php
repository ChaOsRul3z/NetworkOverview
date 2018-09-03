<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function units()
    {
        return $this->morphedByMany(Unit::class, 'propertyable');
    }

    public function devices()
    {
        return $this->morphedByMany(Device::class, 'propertyable');
    }

    public function getValue()
    {
        return $this->pivot->value;
    }
}