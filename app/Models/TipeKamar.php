<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    // ! gunakan tabel tipe_kamar
    protected $table = 'tipe_kamar';
    protected $guarded = ['id'];

    public function Reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
