<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;
    protected $connection = 'ferrum';
    protected $table = 'doc';

    public function clientes()
    {
        return $this->hasOne(Clientes::class, 'CLIENTEID', 'CLIENTEID');
    }

    public function cfd()
    {
        return $this->hasOne(CFD::class, 'DOCID', 'DOCID')->select(['CFDID', 'DOCID','FOLIO']);
    }

    public function Personal()
    {
        return $this->hasOne('Laraspace\Per', 'EMISOR', 'CATEGORIA');
    }
}
