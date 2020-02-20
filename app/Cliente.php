<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ['nombre', 'activo'];
    protected $guarded = ['cliente_id']; 

    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
