<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    protected $fillable = ['name', 'viewbox'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getFloorBorders()
    {
        return  "floor.partials.{$this->id}_borders";
    }
}
