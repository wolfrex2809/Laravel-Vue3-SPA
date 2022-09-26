<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;

    public $fillable = [
        'name',
        'address',
        'status',
        'race_id'
    ];

    public function race(){
        return $this->hasOne(Race::class, 'id', 'race_id');
    }
}
