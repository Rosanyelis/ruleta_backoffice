<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Combinacion;

class CombinacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combinaciones = Combinacion::all();
        return view('combinaciones.index', compact('combinaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('combinaciones.create');
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
            'nombre' => ['required'],
            'tipo' => ['required'],
            'pago' => ['required'],
        ],[
            'nombre.required' => 'El valor del campo Nombre es obligatorio.',
            'tipo.required' => 'El valor del campo Tipo es obligatorio.',
            'pago.required' => 'El valor del campo Paga es obligatorio.',
        ]);

        $nombre = $request->input('nombre');
        $tipo = $request->input('tipo');
        $pago = $request->input('pago');

        # create
        $dato = New Combinacion;
        $dato->nombre = $nombre;
        $dato->tipo = $tipo;
        $dato->pago = $pago;
        $dato->save();

        return redirect('/combinaciones')->with('success', 'Nueva Combinación Creada Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = Combinacion::where('id', $id)->count();
        if($count>0){
            $data = Combinacion::where('id', $id)->first();
            return view('combinaciones.edit', compact('data'));
        }else{
            return redirect('/combinaciones')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Combinacion::where('id', $id)->count();
        if($count>0){
            $request->validate([
                'nombre' => ['required'],
                'tipo' => ['required'],
                'pago' => ['required'],
            ],[
                'nombre.required' => 'El valor del campo Nombre es obligatorio.',
                'tipo.required' => 'El valor del campo Tipo es obligatorio.',
                'pago.required' => 'El valor del campo Paga es obligatorio.',
            ]);

            $nombre = $request->input('nombre');
            $tipo = $request->input('tipo');
            $pago = $request->input('pago');

            # create
            $dato = Combinacion::where('id', $id)->first();;
            $dato->nombre = $nombre;
            $dato->tipo = $tipo;
            $dato->pago = $pago;
            $dato->save();

            return redirect('/combinaciones')->with('success', 'Combinación Actualizada Exitosamente!');
        }else{
            return redirect('/combinaciones')->with('Error', 'Problemas para visualizar el registro');
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
        //
    }
}
