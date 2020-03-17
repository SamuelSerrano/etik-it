<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColaProducto extends Model
{
    protected $table = "cola_productos";
    protected $fillable = [
        'lote_id', 'uid' , 'producto_id', 'hash_cadena','fechaRegistro'
    ];

    protected $guarded = ['id']; 
}
