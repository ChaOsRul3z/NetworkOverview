<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'room_id', 'type_id'];

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function properties()
    {
        return $this->morphToMany(Property::class, 'propertyable')->withPivot('value');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function getIp()
    {
        if ($this->properties->where('name', 'ip')->first()) {
            return $this->properties->where('name', 'ip')->first()->pivot->value;
        }
        return '';
    }
}
