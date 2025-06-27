<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Parametro extends Model
{
    /** @use HasFactory<\Database\Factories\ParametroFactory> */
    use HasFactory;
    

    protected $table = "parametros";

    public $primaryKey = "idtipo";
    public $timestamps = false;

    protected $fillable = [
        "idtipo","numeracion","serie","estado"
    ];

    public static function actualizarNumero($idtipo, $numeracion){
        try{
            DB::table('parametros')->where("idtipo" , "=", $idtipo)->update(["numeracion" => $numeracion]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function tipo(){
        return $this->hasOne("idtipo");
    }
}
