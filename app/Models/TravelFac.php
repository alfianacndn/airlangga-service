<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelFac extends Model
{
    use HasFactory;
    protected $table = 'travel_fac';
    protected $fillable = [
        "facility_id", "fac_nm", "travel_pack_id",
    ];
}
