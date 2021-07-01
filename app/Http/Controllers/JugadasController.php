<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugada;

class JugadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jugadas = Jugada::all();
        return view('jugadas.index', compact('jugadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jugadas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:35|unique:jugadas',
        ],[
            'nombre.required' => 'El valor del campo Nombre de Jugada es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombre de Jugada no debe ser mayor a :max.',
                'file'    => 'El archivo Nombre de Jugada no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombre de Jugada no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombre de Jugada no debe contener más de :max elementos.',
            ],
        ]);
        
        $nombre = $request->input('nombre');

        $jugada = new Jugada;
        $jugada->nombre = $nombre;
        $jugada->save();

        return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('success', 'Jugada Creada Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = Jugada::where('id', $id)->count();
        if($count>0){
            
            $jugadas = Jugada::where('id', $id)->first();

            return view('jugadas.show', compact('jugadas'));
        }else{
            return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('Error', 'Problemas para visualizar el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = Jugada::where('id', $id)->count();
        if($count>0){
            
            $jugadas = Jugada::where('id', $id)->first();

            return view('jugadas.edit', compact('jugadas'));
        }else{
            return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('Error', 'Problemas para visualizar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $count = Jugada::where('id', $id)->count();
        if($count>0){
            
            $request->validate([
                'nombre' => 'required|string|max:35|unique:jugadas',
            ],[
                'nombre.required' => 'El valor del campo Nombre de Jugada es obligatorio.',
                'nombre.max' => [
                    'numeric' => 'El campo Nombre de Jugada no debe ser mayor a :max.',
                    'file'    => 'El archivo Nombre de Jugada no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Nombre de Jugada no debe contener más de :max caracteres.',
                    'array'   => 'El campo Nombre de Jugada no debe contener más de :max elementos.',
                ],
            ]);
            
            $nombre = $request->input('nombre');
    
            $jugada = Jugada::where('id', $id)->first();
            $jugada->nombre = $nombre;
            $jugada->save();
    
            return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('success', 'Jugada Editada Exitosamente!');
        }else{
            return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('Error', 'Problemas para visualizar el registro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Jugada::where('id', $id)->count();
        if($count>0){
            
            Jugada::where('id', $id)->delete();

            return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('success', 'Jugada Eliminada Exitosamente!');
        }else{
            return redirect('/plantilla-de-jugadas/configurar-jugadas')->with('Error', 'Problemas para visualizar el registro');
        }
    }
}
