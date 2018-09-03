<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sort extends Model
{
    protected $fillable = ['name', 'color'];

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
