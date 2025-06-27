<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CabeceraVenta;
use App\Models\DetalleVenta; 
use Illuminate\Http\Request;
use DB; 
use App\Models\Producto; 
use App\Models\Cliente; 
use App\Models\Tipo; 
use App\Models\Parametro; 
class VentaController extends Controller
{
    const PAGINATION=8; 
    /**public function index() 
    { 
        $venta = CabeceraVenta::where('estado','=','1')->
        paginate($this::PAGINATION);                 
        return view('movimiento.registro ventas.index',compact('venta')); 
    } 
    */
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $venta = CabeceraVenta::join('tipos','tipos.idtipo','=','cabecera_ventas.idtipo')
        ->where("cabecera_ventas.estado","=","1")->where("tipos.descripcion","like","%". $buscarpor ."%")
        ->select('cabecera_ventas.*')
        ->paginate($this::PAGINATION);
        
        return view("movimiento.registro ventas.index",compact('venta', 'buscarpor'));
    }
    

    /**
     * Show the form for creating a new resource.
    */
    
    public function create() 
    { 
        $cliente=DB::table('clientes')->get(); 
        $producto=DB::table('productos')->get(); 
        $tipo=Tipo::all(); 
        $tipou=Tipo::select('idtipo','descripcion')->orderBy('idtipo','DESC')->get();                          
        $parametros=Parametro::findOrFail($tipou[0]->idtipo);            
        return view('movimiento.registro ventas.create',compact('tipo','parametros','cliente','producto')); 
    } 


    /*
    public function create()
    {
        $cliente=DB::table('clientes')->get(); 
        $producto=DB::table('productos')->get(); 
        $tipo=Tipo::all(); 
        $tipou=Tipo::select('idtipo','descripcion')->orderBy('idtipo','DESC')->get(); 
        $parametros=Parametro::findOrFail($tipou[0]->idtipo); 
        return view('mantenedor.ventas.create',compact('tipo','parametros','cliente','producto')); 
    }
    */
    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request) 
    { 
        try { 
            DB::beginTransaction();         
            /* Grabar Cabecera */ 
            /* Obtiene codigo cliente a partir del dni */ 
            $cliente=Cliente::where('ruc_dni','=',$request->ruc)->get(); 
            $idcliente=$cliente[0]->idcliente;             
            $venta=new CabeceraVenta(); 
            $venta->idcliente=$idcliente; 
            $venta->nrodoc=$request->get('nrodoc');         
            $venta->idtipo=$request->seltipo;            
            $arr = explode('/', $request->fecha); 
            $nFecha = $arr[2].'-'.$arr[1].'-'.$arr[0];      
            $venta->fechaventa=$nFecha;     
             
            if ($request->seltipo='2') 
                {                         
                    $venta->total=$request->total;            
                    $venta->subtotal='0'; 
                    $venta->igv='0'; 
                } 
            else 
                { 
                    $venta->total='100'; 
                     
                    $venta->subtotal='0'; 
                    $venta->igv='0'; 
                } 
                     
            $venta->estado='1'; 
            $venta->save(); 
            /* Grabar Detalle */ 
            //$detalleventa=$request->get('detalles');          
 
            $idproducto = $request->get('cod_producto'); 
            $cantidad = $request->get('cantidad'); 
            $pventa = $request->get('pventa');             
 
            $cont = 0; 
 
            while ($cont<count($idproducto)) { 
                $detalle=new DetalleVenta(); 
                $detalle->idventa=$venta->idventa; 
                $detalle->idproducto=$idproducto[$cont]; 
                $detalle->cantidad=$cantidad[$cont]; 
                $detalle->precio=$pventa[$cont];                 
                $detalle->save(); 
                  /* Actualizar stock */ 
                Producto::actualizarStock($detalle->idproducto,$detalle->cantidad);                          
                $cont=$cont+1; 
            }         
            /* Actualizar el numero de documento en la tabla parametro */ 
          /* if ($venta->tipo_id=="2") 
                $nroNuevo="002-".str_pad((substr($request
>get('nrodoc'),5,11)+1),6,"0", STR_PAD_LEFT);    
            elseif ($venta->tipo_id=="1") 
                 $nroNuevo="001-".str_pad((substr($request
>get('nrodoc'),5,11)+1),6,"0", STR_PAD_LEFT);    
 
            parametros::ActualizarNumero($venta->tipo_id, $nroNuevo);*/ 
 
            DB::commit();                 
            return redirect()->route('ventas.index'); 
        }  
        catch (Exception $e) { 
            DB::rollback(); 
        }             
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    /* Para select2 Buscar Productos */     
    public function ProductoCodigo($producto_id){ 
        return DB::table('productos as p')->join('unidades as u','p.idunidad','=','u.idunidad')                  
         ->where('p.estado','=','1')->where('p.idproducto','=',$producto_id) 
        ->select('p.idproducto','p.descripcion','u.descripcion as unidad','p.precio','p.stock')->get();     
    } 

    public function PorTipo($idtipo) 
    {         
        //return Tipo::where('descripcion','=',$descripcion)->get(); 
        return DB::table('tipos as t')->join('parametros as p','p.idtipo','=','t.idtipo')                  
         ->where('t.idtipo','=',$idtipo)
         ->select('t.idtipo','t.descripcion','p.serie','p.numeracion')->get();  
    } 
} 
 

