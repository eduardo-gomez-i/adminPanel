<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoDocumento extends Model
{
    use HasFactory;
    protected $table = 'pagdoc';

    public function Documento()
    {
        return $this->hasOne(Documentos::class, 'DOCID', 'DOCID');
    }
}
