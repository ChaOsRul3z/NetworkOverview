<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rutorika\Sortable\SortableTrait;

class Unit extends Model
{
    use SortableTrait;

    protected $fillable = ['name', 'position', 'type_id', 'rack_id'];

    protected static function boot()
    {
        parent::boot();
        Unit::created(function ($unit) {
            for ($count = 1; $count < ($unit->type->port_count + 1); $count++) {
                $port = $unit->ports()->create([
                    'unit_id' => $unit->id,
                    'label' => $count,
                    'speed' => 100,
                ]);
            }
        });

        Unit::deleting(function ($unit) {
            $unit->ports()->delete();
        });
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function properties()
    {
        return $this->morphToMany(Property::class, 'propertyable')->withPivot('value');
    }

    public function getIp()
    {
        $ip = $this->properties->where('name', 'ip');
        return  (sizeof($ip)) ? $ip->first()->pivot->value : '';
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function ports()
    {
        return $this->hasMany(Port::class);
    }
}
