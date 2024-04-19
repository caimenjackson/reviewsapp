<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';
    protected $primaryKey = 'gPlusPlaceId';
    public $incrementing = false;

    protected $fillable = ['gPlusPlaceId', 'name', 'price', 'address', 'hours', 'phone', 'closed'];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'gPlusPlaceId', 'gPlusPlaceId');
    }
}
