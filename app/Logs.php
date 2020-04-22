<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    //
    protected $table = "logs";
    protected $fillable = [
        'uid', 'geolocation','product_code', 'categoria_id', 'activo'
    ];

    protected $guarded = ['id']; 

    

}
