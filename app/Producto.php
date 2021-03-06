<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    protected $fillable = [
        'nombre', 'descripcion','url_fabricante', 'categoria_id', 'activo'
    ];

    protected $guarded = ['producto_id']; 

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}
