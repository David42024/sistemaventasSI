<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unidad;
class UnidadController extends Controller
{
    const PAGINATION = 8;

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $unidades = Unidad::where('estado','=','1')->where('descripcion','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('mantenedor.unidades.index', compact('unidades','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mantenedor.unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:20',
        ],
        [
            'descripcion.required' => 'dec requer',
            'descripcion.max' => 'max 20 caract',
        ]);
        $unidad = new Unidad();
        $unidad->descripcion = $request->descripcion;
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos','Tipo creado :D');
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
        $unidad = Unidad::findOrFail($id);
        return view('mantenedor.unidades.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:20'
        ],
        [
            'descripcion.required' => 'desc requer',
            'descripcion.max' => 'max 20 caract'
        ]);
        $unidad = Unidad::findOrFail($id);
        $unidad->descripcion = $request->descripcion;
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos','editado correctamente :D');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Id)
    {
        $unidad = Unidad::findOrFail($Id);
        $unidad->estado='0';
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos','eliminado hecho');
    }

    public function confirmar($Id){ 
        $unidad = Unidad::findOrFail($Id); 
        return view('mantenedor.unidades.confirmar', compact('unidad')); 
    }

    public function cancelar()
    {
        return redirect()->route('unidades.index')->with('datos', 'Acción cancelada..!');
    }
}
