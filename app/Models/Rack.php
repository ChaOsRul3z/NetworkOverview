<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rack extends Model
{
    protected $fillable = ['name', 'size', 'room_id', 'units_used'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class)->sorted();
    }

    public function nextAvailablePosition()
    {
        if (!$this->units->count() <= 0) {
            $unit = $this->units->last();
            return $unit->position + 1;
        }
        return 1;
    }
}
