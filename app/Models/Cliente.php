<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected $table = "clientes";

    protected $primaryKey = "idcliente";

    public $timestamps = false;

    protected $filliable = [
        "ruc_dni","apellidos","nombres","email","direccion","estado"
    ];

    public function ventas(){
        return $this->hasMany(CabeceraVenta::class,"idcliente","idcliente");
    }
    
}
