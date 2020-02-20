<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ['nombre', 'activo'];
    protected $guarded = ['cliente_id']; 

    protected $casts = [
        'activo' => 'boolean'        
    ];
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
