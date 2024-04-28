<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['gPlusPlaceId', 'gPlusUserId', 'rating', 'reviewerName', 'reviewText', 'categories', 'reviewTime'];

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'gPlusUserId', 'gPlusUserId');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'gPlusPlaceId', 'gPlusPlaceId');
    }


    protected $table = 'reviews'; 

    protected $casts = [
        'reviewTime' => 'datetime', 
    ];
}