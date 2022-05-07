<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasHotel extends Model
{
    use HasFactory;

    // ! gunakan tabel fasilitas_hotel
    protected $table = 'fasilitas_hotel';
    protected $guarded = ['id'];
}
