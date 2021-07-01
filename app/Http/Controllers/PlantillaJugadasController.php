<?php

namespace App\Http\Controllers;

use App\Models\Jugada;
use App\Models\PlantillaJugadaJugada;
use App\Models\PlantillaJugada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantillaJugadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantillas = PlantillaJugada::all();
        return view('plantilla_jugadas.index', compact('plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jugadas'] = Jugada::all()->pluck('nombre', 'id');
        return view('plantilla_jugadas.create', ['data' => $data]);
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
            'jugada' => 'required',
        ],[
            'nombre.required' => 'El valor del campo  Nombre de Plantilla es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombre de Plantilla no debe ser mayor a :max.',
                'file'    => 'El archivo Nombre de Plantilla no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombre de Plantilla no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombre de Plantilla no debe contener más de :max elementos.',
            ],
            'jugada.required' => 'El valor del campo Jugadas es obligatorio',
            // 'jugada.uuid' => 'El campo Jugada debe ser un UUID válido.',
        ]);
        
        // dd($request);
        $nombre = $request->input('nombre');
        
        $plantilla = new PlantillaJugada;
        $plantilla->nombre = $nombre;
        $plantilla->save();

        $jugadas = $request->input('jugada');
        
        foreach ($jugadas as $jugada_id) {
            PlantillaJugadaJugada::create([
                'plantilla_jugada_id' => $plantilla->id,
                'jugada_id' => $jugada_id,
            ]);
        }

        return redirect('/plantilla-de-jugadas')->with('success', 'Plantilla Creada Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = PlantillaJugada::where('id', $id)->count();
        if($count>0){
            
            $plantilla = PlantillaJugada::where('id', $id)->first();

            $jugadas = DB::table('plantilla_jugadas')
                            ->join('plantilla_jugadas_jugadas', 'plantilla_jugadas_jugadas.plantilla_jugada_id', 'plantilla_jugadas.id')
                            ->join('jugadas', 'plantilla_jugadas_jugadas.jugada_id', 'jugadas.id')
                            ->where('plantilla_jugadas.id', $id)
                            ->select('jugadas.nombre')
                            ->get();

            return view('plantilla_jugadas.show', compact('plantilla', 'jugadas'));
        }else{
            return redirect('/plantilla-de-ruletas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaJugada::where('id', $id)->count();
        if($count>0){
            
            $plantilla = PlantillaJugada::where('id', $id)->first();

            $data['jugadas'] = Jugada::all()->pluck('nombre', 'id');

            $pivote_jugada_id = [];

            foreach ($plantilla->plantillajugadajugadas as $plantillajugada):
                $pivote_jugada_id[] = $plantillajugada->jugada_id;
            endforeach;

            $data['plantilla_jugada_jugada'] = 
                    PlantillaJugadaJugada::whereIn('jugada_id', $pivote_jugada_id)
                    ->get()
                    ->pluck('jugada_id');

            return view('plantilla_jugadas.edit', compact('plantilla'), ['data' => $data]);
        }else{
            return redirect('/plantilla-de-jugadas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaJugada::where('id', $id)->count();
        if($count>0){
            $request->validate([
                'nombre' => 'required|string|max:50',
                'jugada' => 'required',
            ],[
                'nombre.required' => 'El valor del campo  Nombre de Plantilla es obligatorio.',
                'nombre.max' => [
                    'numeric' => 'El campo Nombre de Plantilla no debe ser mayor a :max.',
                    'file'    => 'El archivo Nombre de Plantilla no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Nombre de Plantilla no debe contener más de :max caracteres.',
                    'array'   => 'El campo Nombre de Plantilla no debe contener más de :max elementos.',
                ],
                'jugada.required' => 'El valor del campo Jugadas es obligatorio',
                // 'jugada.uuid' => 'El campo Jugada debe ser un UUID válido.',
            ]);
            
            $nombre = $request->input('nombre');
            
            $plantilla = PlantillaJugada::where('id', $id)->first();
            $plantilla->nombre = $nombre;
            $plantilla->save();
    
            $jugadas = $request->input('jugada');
            
            PlantillaJugadaJugada::where('plantilla_jugada_id', $plantilla->id)->delete();

            foreach ($jugadas as $jugada_id) {
                PlantillaJugadaJugada::create([
                    'plantilla_jugada_id' => $plantilla->id,
                    'jugada_id' => $jugada_id,
                ]);
            }
    
            return redirect('/plantilla-de-jugadas')->with('success', 'Plantilla Actualizada Exitosamente!');
        }else{
            return redirect('/plantilla-de-jugadas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaJugada::where('id', $id)->count();
        if($count>0){
            
            PlantillaJugada::where('id', $id)->delete();
            PlantillaJugadaJugada::where('plantilla_jugada_id', $id)->delete();

            return redirect('/plantilla-de-jugadas')->with('success', 'Plantilla de Jugada Eliminada Exitosamente!');
        }else{
            return redirect('/plantilla-de-jugadas')->with('Error', 'Problemas para visualizar el registro');
        }
    }
}
