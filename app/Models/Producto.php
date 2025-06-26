<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    
    protected $table = "productos";
    protected $primaryKey = "idproducto";
    public $timestamps = false;

    protected $fillable = [
        "descripcion","idcategoria","idunidad","stock","precio","estado"
    ];

    public function categoria(){
        return $this->hasOne(Categoria::class,"idcategoria","idcategoria");
    }

    public function unidad(){
        return $this->hasOne(Unidad::class,"idunidad","idunidad");
    }

    public static function actualizarStock($idproducto, $cantidadquitada){
        return DB::update(
            "UPDATE productos set stock = stock - ? where idproducto = ?",
            [$cantidadquitada, $idproducto]
        );
    }


}


