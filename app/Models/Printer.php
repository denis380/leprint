<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    protected $table = 'printers';
    protected $fillable = ['serial', 'modelo', 'coluna', 'galpao', 'contador', 'area', 'responsavel', 'ip', 'situacao', 'etiqueta'];
    protected $guarded = ['id', 'created_at', 'update_at'];

}
