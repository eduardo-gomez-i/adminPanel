<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'nombrered',
        'ubicacion'
    ];

    public function ubicaciones()
    {
        return $this->belongsToMany(Ubicacion::class);
    }
}
