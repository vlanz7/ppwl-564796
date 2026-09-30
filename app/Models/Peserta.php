<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $primaryKey = 'id_peserta';

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_peserta', 'id_peserta');
    }
}
