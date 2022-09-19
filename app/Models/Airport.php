<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    protected $fillable = [
        'ident',
        'type',
        'name',
        'elevation_ft',
        'continent',
        'iso_country',
        'iso_region',
        'municipality',
        'gps_code',
        'iata_code',
        'local_code',
        'coordinates'
    ];
}
