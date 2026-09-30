<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }
}
