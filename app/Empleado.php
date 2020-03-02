<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empleado extends Authenticatable
{
    use Notifiable;
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
