<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {
    protected $fillable = [
        'name',
        'shop_id',
    ];

    public function medicine() {
        return $this->hasMany( Medicine::class );
    }

}
