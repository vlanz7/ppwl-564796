<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriProgram extends Model
{
    protected $table = 'galeri_program';
    protected $primaryKey = 'id_galeri';
    protected $fillable = ['id_program', 'judul', 'deskripsi', 'foto'];
    
    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }
}
