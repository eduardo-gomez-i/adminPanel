<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $connection = 'checador';
    protected $table = 'asistencia';

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'id_trabajador', 'id');
    }

}
