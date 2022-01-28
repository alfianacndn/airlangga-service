<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelImg extends Model
{
    use HasFactory;
    protected $table = 'travel_img';
    protected $fillable = [
        "travel_pack_id"
    ];
}
