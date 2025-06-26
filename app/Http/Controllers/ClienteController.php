<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINATION = 8;

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $clientes = Cliente::where('estado','=','1')->where('ruc_dni','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('mantenedor.clientes.index', compact('clientes','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mantenedor.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = request()->validate([
            'ruc_dni' => 'required|max:191',
            'apellidos' => 'required|max:80',
            'nombres' => 'required|max:50',
            'email' => 'required|max:100',
            'direccion' => 'required|max:80',
        ],
        [
            'ruc_dni.required' => 'ruc o dni requer',
            'ruc_dni.max' => 'max 191 caract',
            'apellidos.required' => 'apellidos requer',
            'apellidos.max' => 'max 80 caract',
            'nombres.required' => 'nombres requer',
            'nombres.max' => 'max 50 caract',
            'email.required' => 'email requer',
            'email.max' => 'max 100 caract',
            'direccion.required' => 'direccion requer',
            'direccion.max' => 'max 80 caract',
        ]);
        $cliente = new Cliente();
        $cliente->ruc_dni = $request->ruc_dni;
        $cliente->apellidos = $request->apellidos;
        $cliente->nombres = $request->nombres;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return redirect()->route('clientes.index')->with('datos','Tipo creado :D');
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
        $cliente = Cliente::findOrFail($id);
        return view('mantenedor.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate([
            'ruc_dni' => 'required|max:191',
            'apellidos' => 'required|max:80',
            'nombres' => 'required|max:50',
            'email' => 'required|max:100',
            'direccion' => 'required|max:80',
        ],
        [
            'ruc_dni.required' => 'ruc o dni requer',
            'ruc_dni.max' => 'max 191 caract',
            'apellidos.required' => 'apellidos requer',
            'apellidos.max' => 'max 80 caract',
            'nombres.required' => 'nombres requer',
            'nombres.max' => 'max 50 caract',
            'email.required' => 'email requer',
            'email.max' => 'max 100 caract',
            'direccion.required' => 'direccion requer',
            'direccion.max' => 'max 80 caract',
        ]);
        $cliente = Cliente::findOrFail($id);
        $cliente->ruc_dni = $request->ruc_dni;
        $cliente->apellidos = $request->apellidos;
        $cliente->nombres = $request->nombres;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return redirect()->route('clientes.index')->with('datos','editado correctamente :D');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Id)
    {
        $cliente = Cliente::findOrFail($Id);
        $cliente->estado='0';
        $cliente->save();
        return redirect()->route('clientes.index')->with('datos','eliminado hecho');
    }

    public function confirmar($Id){ 
        $cliente = Cliente::findOrFail($Id); 
        return view('mantenedor.clientes.confirmar', compact('cliente')); 
    }

    public function cancelar()
    {
        return redirect()->route('clientes.index')->with('datos', 'Acción cancelada..!');
    }
}
