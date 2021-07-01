<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use App\Models\PlantillaHorario;
use App\Models\PlantillaHorarioHora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantillaHorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantillas = PlantillaHorario::all();
        return view('plantilla_horarios.index', compact('plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['horas'] = Hora::all()->pluck('hora', 'id');
        return view('plantilla_horarios.create', ['data' => $data]);
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
            'nombre' => 'required|string|max:50',
            'hora' => 'required',
        ],[
            'nombre.required' => 'El valor del campo  Nombre de Plantilla es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombre de Plantilla no debe ser mayor a :max.',
                'file'    => 'El archivo Nombre de Plantilla no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombre de Plantilla no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombre de Plantilla no debe contener más de :max elementos.',
            ],
            'hora.required' => 'El valor del campo Horas es obligatorio',
            // 'hora.uuid' => 'El campo Hora debe ser un UUID válido.',
        ]);
        
        $nombre = $request->input('nombre');
        
        $plantilla = new PlantillaHorario;
        $plantilla->nombre = $nombre;
        $plantilla->save();

        $horas = $request->input('hora');
        
        foreach ($horas as $hora_id) {
            PlantillaHorarioHora::create([
                'plantilla_horario_id' => $plantilla->id,
                'hora_id' => $hora_id,
            ]);
        }

        return redirect('/plantilla-de-horarios')->with('success', 'Plantilla Creada Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = PlantillaHorario::where('id', $id)->count();
        if($count>0){
            
            $plantilla = PlantillaHorario::where('id', $id)->first();

            $horas = DB::table('plantilla_horarios')
                            ->join('plantilla_horarios_hora', 'plantilla_horarios_hora.plantilla_horario_id', 'plantilla_horarios.id')
                            ->join('horas', 'plantilla_horarios_hora.hora_id', 'horas.id')
                            ->where('plantilla_horarios.id', $id)
                            ->select('horas.hora')
                            ->get();

            return view('plantilla_horarios.show', compact('plantilla', 'horas'));
        }else{
            return redirect('/plantilla-de-horarios')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaHorario::where('id', $id)->count();
        if($count>0){
            
            $plantilla = PlantillaHorario::where('id', $id)->first();

            $data['horas'] = Hora::all()->pluck('hora', 'id');

            $pivote_hora_id = [];

            foreach ($plantilla->plantillahorarioshoras as $plantillahorarios):
                $pivote_hora_id[] = $plantillahorarios->hora_id;
            endforeach;

            $data['plantilla_horario_hora'] = 
                    PlantillaHorarioHora::whereIn('hora_id', $pivote_hora_id)
                    ->get()
                    ->pluck('hora_id');

            return view('plantilla_horarios.edit', compact('plantilla'), ['data' => $data]);
        }else{
            return redirect('/plantilla-de-horarios')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaHorario::where('id', $id)->count();
        if($count>0){
            $request->validate([
                'nombre' => 'required|string|max:50',
                'hora' => 'required',
            ],[
                'nombre.required' => 'El valor del campo  Nombre de Plantilla es obligatorio.',
                'nombre.max' => [
                    'numeric' => 'El campo Nombre de Plantilla no debe ser mayor a :max.',
                    'file'    => 'El archivo Nombre de Plantilla no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Nombre de Plantilla no debe contener más de :max caracteres.',
                    'array'   => 'El campo Nombre de Plantilla no debe contener más de :max elementos.',
                ],
                'hora.required' => 'El valor del campo Horas es obligatorio',
                // 'hora.uuid' => 'El campo Hora debe ser un UUID válido.',
            ]);
            
            $nombre = $request->input('nombre');
            
            $plantilla = PlantillaHorario::where('id', $id)->first();
            $plantilla->nombre = $nombre;
            $plantilla->save();
    
            $horas = $request->input('hora');
            
            PlantillaHorarioHora::where('plantilla_horario_id', $plantilla->id)->delete();

            foreach ($horas as $hora_id) {
                PlantillaHorarioHora::create([
                    'plantilla_horario_id' => $plantilla->id,
                    'hora_id' => $hora_id,
                ]);
            }
    
            return redirect('/plantilla-de-horarios')->with('success', 'Plantilla Actualizada Exitosamente!');
        }else{
            return redirect('/plantilla-de-horarios')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaHorario::where('id', $id)->count();
        if($count>0){
            
            PlantillaHorario::where('id', $id)->delete();
            PlantillaHorarioHora::where('plantilla_horario_id', $id)->delete();

            return redirect('/plantilla-de-horarios')->with('success', 'Plantilla de Horarios Eliminada Exitosamente!');
        }else{
            return redirect('/plantilla-de-horarios')->with('Error', 'Problemas para visualizar el registro');
        }
    }
}
