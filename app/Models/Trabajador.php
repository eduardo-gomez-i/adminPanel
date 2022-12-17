<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;
    protected $connection = 'checador';
    protected $table = 'trabajadores';

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
