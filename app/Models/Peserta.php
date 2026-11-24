<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';
    protected $primaryKey = 'id_peserta';
    protected $fillable = [
        'user_id',
        'nama',
        'nomor_hp',
        'alamat',
        'pendidikan_terakhir',
        'usia',
        'jenis_kelamin',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_peserta', 'id_peserta');
    }
}
