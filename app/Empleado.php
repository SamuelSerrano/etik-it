<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = "empleados";
    protected $fillable = [
        'name', 'email', 'password','cliente_id', 'role_id', 'activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = ['empleado_id']; 

    protected $casts = [
        'activo' => 'boolean'        
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
