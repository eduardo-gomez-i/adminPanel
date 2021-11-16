<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $connection = 'ferrum';
    protected $table = 'per';

    public function Documentos()
    {
        return $this->hasMany(Documentos::class, 'EMISOR', 'CATEGORIA');
    }

    public function Partidas()
    {
        return $this->hasMany(Partidas::class, 'EMISOR', 'CATEGORIA');
    }

    public function scopeValidos($query)
    {
        return $query->where('GRUPO', 'VM')
            ->where('CATEGORIA', '!=', 'JC')
            ->where('CATEGORIA', '!=', 'EC')
            ->where('CATEGORIA', '!=', 'PO')
            ->where('CATEGORIA', '!=', 'LB')
            ->where('CATEGORIA', '!=', 'FS')
            ->where('CATEGORIA', '!=', 'LS')
            ->where('CATEGORIA', '!=', 'JC');
    }
}
