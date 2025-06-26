<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleVentaFactory> */
    use HasFactory;

    protected $table = "detalle_ventas";


    public $timestamps = false;

    protected $fillable = [
        "precio","cantidad","idventa","idproducto"
    ];

    public function venta(){
        return $this->hasOne('idventa','idventa');
    }

    public function producto(){
        return $this->hasOne("idproducto","idproducto");
    }
}
