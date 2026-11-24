<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = [
        'id_peserta',
        'id_program',
        'tanggal_pendaftaran',
        'status_pendaftaran',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return ['tanggal_pendaftaran' => 'datetime',];
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pendaftaran','id_pendaftaran');
    }
}
