<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insumos extends Model
{
    use HasFactory;

    protected $table = 'insumos';

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'precio',
        'costo',
        'inventario',
        'imagen',
        'Fabricante',
        'fecha_Vencimiento',
        'Fecha_registro',
        'numero_de_lote'
    ];
}
