<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $timestamps = false;
    protected $fillable = [
        'id_pendaftaran',
        'total_biaya',
        'total_terbayar',
        'status_pembayaran',
    ];

    protected function casts(): array
    {
        return ['total_biaya' => 'decimal:2', 'total_terbayar' => 'decimal:2', 'created_at' => 'datetime',];
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    public function detailPembayaran()
    {
        return $this->hasMany(DetailPembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }
}