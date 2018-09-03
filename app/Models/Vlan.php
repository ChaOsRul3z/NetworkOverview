<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vlan extends Model
{
    protected $fillable = ['number', 'name', 'color'];

    public function ports()
    {
        return $this->belongsToMany(Port::class);
    }

    public function scopeTagged($query)
    {
        return $query->where('tagged', true);
    }

    public function scopeUntagged($query)
    {
        return $query->where('tagged', false);
    }
}
