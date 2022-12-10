<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CFD extends Model
{
    use HasFactory;
    protected $connection = 'ferrum';
    protected $table = 'cfd';
}
