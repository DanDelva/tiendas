<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory;
    protected $fillable = ['isbn',
    'title',
    'Fecha_Pedido',
    'Fecha_Envio',
    'Metodo_Pago',
    'description',
    'total',
    'image',
];
public function clientes() : BelongsToMany{
    return$this->belongsToMany(Cliente::class);

}
}
