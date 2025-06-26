<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINATION = 8;

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $categorias = Categoria::where('estado','=','1')->where('descripcion','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('mantenedor.categorias.index', compact('categorias','buscarpor'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mantenedor.categorias.create');
    }


    public function store(Request $request)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:20',
        ],
        [
            'descripcion.required' => 'dec requer',
            'descripcion.max' => 'max 20 caract',
        ]);
        $categoria = new Categoria();
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos','Tipo creado :D');
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
        $categoria = Categoria::findOrFail($id);
        return view('mantenedor.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, string $id)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:20'
        ],
        [
            'descripcion.required' => 'desc requer',
            'descripcion.max' => 'max 20 caract'
        ]);
        $categoria = Categoria::findOrFail($id);
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos','editado correctamente :D');
    }



    public function destroy(string $Id)
    {
        $categoria = Categoria::findOrFail($Id);
        $categoria->estado='0';
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos','eliminado hecho');
    }

    public function confirmar($Id){ 
        $categoria = Categoria::findOrFail($Id); 
        return view('mantenedor.categorias.confirmar', compact('categoria')); 
    }

    public function cancelar()
    {
        return redirect()->route('categorias.index')->with('datos', 'Acción cancelada..!');
    }

}
