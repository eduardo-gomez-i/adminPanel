<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajas extends Model
{
    use HasFactory;
    protected $connection = 'ferrum';
    protected $table = 'caj';
    protected $keyType = 'string';

    public function clientes()
    {
        return $this->hasOne(Clientes::class, 'CLIENTEID', 'CLIENTEID');
    }

    public function pagdoc()
    {
        return $this->hasOne(PagoDocumento::class, 'CAJAID', 'CAJAID');
    }
}
