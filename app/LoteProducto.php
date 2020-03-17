<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoteProducto extends Model
{
    protected $table = "lote_productos";
    protected $fillable = [
        'lote', 'fechaRegistro', 'fechaVencimiento', 'id_producto', 'cantidad'
    ];

    protected $guarded = ['lote_id']; 

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
