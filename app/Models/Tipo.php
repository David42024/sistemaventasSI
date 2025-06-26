<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    /** @use HasFactory<\Database\Factories\TipoFactory> */
    use HasFactory;

    protected $table = "tipos";
    protected $primaryKey = "idtipo";
    public $timestamps = false;

    protected $fillable = ["descripcion","estado"];

    public function productos(){
        return $this->hasMany(Producto::class,"idtipo","idtipo");
    }
}
