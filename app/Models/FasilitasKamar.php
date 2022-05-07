<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasKamar extends Model
{
    use HasFactory;

    // ! gunakan tabel fasilitas_kamar
    protected $table = 'fasilitas_kamar';
    protected $guarded = ['id'];
}
