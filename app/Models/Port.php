<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable = ['label', 'speed'];

    protected static function boot()
    {
        parent::boot();
        Port::created(function ($port) {
            $port->vlans()->attach(Vlan::first());
        });

        Port::deleting(function ($port) {
            $port->vlans()->detach();

        });
    }

    public function room()
    {
        return $this->belongsToMany(Room::class);
    }

    public function vlans()
    {
        return $this->belongsToMany(Vlan::class)->withPivot('tagged');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getSpeedwithUnit() {
        if ($this->speed >= 1000 && $this->speed < 10000) {
            $value = ($this->speed / ($this->speed / 1));
            return "{$value} Gbit";
        }

        if ($this->speed >= 10000) {
            $value = ($this->speed / ($this->speed / 10));
            return "{$value} Gbit";
        }

        return "{$this->speed} Mbit";
    }
}
