<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id_program';

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_program', 'id_program');
    }
}
