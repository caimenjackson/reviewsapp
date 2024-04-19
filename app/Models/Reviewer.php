<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    protected $table = 'reviewers';
    protected $primaryKey = 'gPlusUserId';
    public $incrementing = false; // Important if the primary key is not an auto-incrementing integer

    protected $fillable = ['gPlusUserId', 'userName', 'jobs', 'currentPlace', 'previousPlace', 'education'];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'gPlusUserId', 'gPlusUserId');
    }
}
