<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ['nombre','razon_social','rep_legal',
                            'nit','direccion','tel_contacto', 'per_contacto', 
                            'email_contacto', 'email_alertas', 'activo'];
    protected $guarded = ['cliente_id']; 

    protected $casts = [
        'activo' => 'boolean'        
    ];
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
