<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use Illuminate\Http\Request;

class HorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horas = Hora::all();
        return view('horas.index', compact('horas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horas.create');
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
            'hora' => 'required',
        ],[
            'hora.required' => 'El valor del campo Hora es obligatorio.',
            'hora.max' => [
                'numeric' => 'El campo Hora no debe ser mayor a :max.',
                'file'    => 'El archivo Hora no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Hora no debe contener más de :max caracteres.',
                'array'   => 'El campo Hora no debe contener más de :max elementos.',
            ],
        ]);
        
        $hora = $request->input('hora');

        $horario = new Hora;
        $horario->hora = $hora;
        $horario->save();

        return redirect('/plantilla-de-horario/configurar-horas')->with('success', 'Hora Creada Exitosamente!');
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
        $count = Hora::where('id', $id)->count();
        if($count>0){
            
            $horas = Hora::where('id', $id)->first();

            return view('horas.edit', compact('horas'));
        }else{
            return redirect('/plantilla-de-horarios/configurar-horas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Hora::where('id', $id)->count();
        if($count>0){
            
            $request->validate([
                'hora' => 'required',
            ],[
                'hora.required' => 'El valor del campo Hora es obligatorio.',
                'hora.max' => [
                    'numeric' => 'El campo Hora no debe ser mayor a :max.',
                    'file'    => 'El archivo Hora no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Hora no debe contener más de :max caracteres.',
                    'array'   => 'El campo Hora no debe contener más de :max elementos.',
                ],
            ]);
            
            $hora = $request->input('hora');
    
            $horario = Hora::where('id', $id)->first();
            $horario->hora = $hora;
            $horario->save();
    
            return redirect('/plantilla-de-horarios/configurar-horas')->with('success', 'Hora Editada Exitosamente!');
        }else{
            return redirect('/plantilla-de-horarios/configurar-horas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Hora::where('id', $id)->count();
        if($count>0){
            
            Hora::where('id', $id)->delete();

            return redirect('/plantilla-de-horarios/configurar-horas')->with('success', 'Hora Eliminada Exitosamente!');
        }else{
            return redirect('/plantilla-de-horarios/configurar-horas')->with('Error', 'Problemas para visualizar el registro');
        }
    }
}
