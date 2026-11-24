<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id_program';
    protected $fillable = [
        'nama_program',
        'deskripsi',
        'biaya',
        'durasi',
        'kuota',
        'status',
        'gambar',
    ];
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_program', 'id_program');
    }
    
    public function galeri()
    {
        return $this->hasMany(GaleriProgram::class, 'id_program', 'id_program');
    }
}
