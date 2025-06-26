<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cliente;

class CabeceraVenta extends Model
{
    /** @use HasFactory<\Database\Factories\CabeceraVentaFactory> */
    use HasFactory;

    protected $table = "cabecera_ventas";
    protected $primaryKey = "idventa";

    public $timestamps = false;

    protected $fillable = [
        "idcliente",
        "fechaventa",
        "idtipo",
        "total",
        "nrodoc",
        "subtotal",
        "igv",
        "estado"
    ];
    
    public function cliente(){
        return $this->hasOne(Cliente::class,"idcliente","idcliente");
    }

    public function tipo(){
        return $this->hasOne(Tipo::class, "idtipo","idtipo");
    }

    public function detalleventas(){
        return $this->hasMany(DetalleVenta::class, "idventa","idventa");
    }


}
