<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $table = "categorias";

    protected $primaryKey = "idcategoria";

    public $timestamps = false;

    protected $fillable = [
        "descripcion","estado"
    ];

}
