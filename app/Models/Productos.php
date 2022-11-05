<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $connection = 'ferrum';
    protected $table = 'vista_productos';

    public function etiquetas()
    {
        return $this->hasMany(Etiquetas::class, 'CLAVE', 'clave_producto');
    }
}
