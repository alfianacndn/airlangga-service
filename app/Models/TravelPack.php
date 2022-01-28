<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPack extends Model
{
    use HasFactory;
    protected $table = 'travel_pack';
    protected $fillable = [
        "pack_nm", "city" , "price", "pack_desc", "use_mk", "create_user"
    ];
}
