<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Unidad;
class ProductoController extends Controller
{
    
    const PAGINATION = 8;

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $productos = Producto::where('estado','=','1')->where('descripcion','like','%'.$buscarpor.'%')
        ->whereHas('categoria', function($query){
            $query->where('estado','=','1');
        })
        ->whereHas('unidad', function($query){
            $query->where('estado','=','1');
        })
        ->paginate($this::PAGINATION);
        return view('mantenedor.productos.index', compact('productos','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $categorias = Categoria::where("estado","=","1")->get();
        $unidades = Unidad::where("estado","=","1")->get();
        return view('mantenedor.productos.create', compact('categorias','unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:20',
            'stock' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0'
        ],
        [
            'descripcion.required' => 'dec requer',
            'descripcion.max' => 'max 20 caract',
            'stock.required' => 'stock requer',
            'precio.required' => 'precio requer',
        ]);
        $producto = new Producto();
        $producto->descripcion = $request->descripcion;
        $producto->idcategoria = $request->idcategoria;
        $producto->idunidad = $request->idunidad;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        $producto->save();
        return redirect()->route('productos.index')->with('datos','Tipo creado :D');
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
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::where('estado','=','1')->get();
        $unidades = Unidad::where('estado','=','1')->get();
        return view('mantenedor.productos.edit', compact('producto','categorias','unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:20',
            'stock' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0'
        ],
        [
            'descripcion.required' => 'dec requer',
            'descripcion.max' => 'max 20 caract',
            'stock.required' => 'stock requer',
            'precio.required' => 'precio requer',
        ]);
        $producto = Producto::findOrFail($id);
        $producto->descripcion = $request->descripcion;
        $producto->idcategoria = $request->idcategoria;
        $producto->idunidad = $request->idunidad;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        $producto->save();
        return redirect()->route('productos.index')->with('datos','editado correctamente :D');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Id)
    {
        $producto = Producto::findOrFail($Id);
        $producto->estado='0';
        $producto->save();
        return redirect()->route('productos.index')->with('datos','eliminado hecho');
    }

    public function confirmar($Id){ 
        $producto = Producto::findOrFail($Id); 
        return view('mantenedor.productos.confirmar', compact('producto')); 
    }

    public function cancelar()
    {
        return redirect()->route('productos.index')->with('datos', 'Acción cancelada..!');
    }

}
