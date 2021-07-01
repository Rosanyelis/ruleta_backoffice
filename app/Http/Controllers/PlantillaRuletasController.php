<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PlantillaRuleta;
use App\Models\Ruleta;
use App\Models\PlantillaRuletaRuleta;

class PlantillaRuletasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantillas = PlantillaRuleta::all();
        return view('plantilla_ruletas.index', compact('plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['ruletas'] = Ruleta::all()->pluck('nombre', 'id');
        return view('plantilla_ruletas.create', ['data' => $data]);
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
            'nombre' => 'required|string|max:35',
            // 'ruleta' => 'uuid',
        ],[
            'nombre.required' => 'El valor del campo  Nombre de Plantilla es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombre de Plantilla no debe ser mayor a :max.',
                'file'    => 'El archivo Nombre de Plantilla no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombre de Plantilla no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombre de Plantilla no debe contener más de :max elementos.',
            ],
            // 'ruleta.uuid' => 'El valor UUID del campo Ruletas debe ser válido.',
        ]);
        
        $plantilla = $request->input('nombre');
        
        $molde = new PlantillaRuleta;
        $molde->nombre = $plantilla;
        $molde->save();

        $ruletas = $request->input('ruleta');
        
        foreach ($ruletas as $ruleta_id) {
            PlantillaRuletaRuleta::create([
                'plantilla_ruleta_id' => $molde->id,
                'ruleta_id' => $ruleta_id,
            ]);
        }

        return redirect('/plantilla-de-ruletas')->with('success', 'Plantilla Creada Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = PlantillaRuleta::where('id', $id)->count();
        if($count>0){
            
            $plantilla = PlantillaRuleta::where('id', $id)->first();

            $ruletas_img = DB::table('plantilla_ruletas')
                            ->join('plantilla_ruletas_ruletas', 'plantilla_ruletas_ruletas.plantilla_ruleta_id', 'plantilla_ruletas.id')
                            ->join('ruletas', 'plantilla_ruletas_ruletas.ruleta_id', 'ruletas.id')
                            ->where('plantilla_ruletas.id', $id)
                            ->select('ruletas.url_imagen')
                            ->get();

            return view('plantilla_ruletas.show', compact('plantilla', 'ruletas_img'));
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
        $count = PlantillaRuleta::where('id', $id)->count();
        if($count>0){
            
            $plantilla = PlantillaRuleta::where('id', $id)->first();

            $data['ruletas'] = Ruleta::all()->pluck('nombre', 'id');

            $plantillaruleta_ruleta_id = [];

            foreach ($plantilla->plantillaruletasruletas as $plantillaruleta):
                $plantillaruleta_ruleta_id[] = $plantillaruleta->ruleta_id;
            endforeach;

            $data['plantilla_ruleta_ruleta'] = PlantillaRuletaRuleta::whereIn('ruleta_id', $plantillaruleta_ruleta_id)->get()->pluck('ruleta_id');

            return view('plantilla_ruletas.edit', compact('plantilla'), ['data' => $data]);
        }else{
            return redirect('/plantilla-de-ruletas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaRuleta::where('id', $id)->count();
        if($count>0){
            $request->validate([
                'nombre' => 'required|string|max:35',
            ],[
                'nombre.required' => 'El valor del campo  Nombre de Plantilla es obligatorio.',
                'nombre.max' => [
                    'numeric' => 'El campo Nombre de Plantilla no debe ser mayor a :max.',
                    'file'    => 'El archivo Nombre de Plantilla no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Nombre de Plantilla no debe contener más de :max caracteres.',
                    'array'   => 'El campo Nombre de Plantilla no debe contener más de :max elementos.',
                ],
            ]);
            
            $plantilla = $request->input('nombre');
            
            $molde = PlantillaRuleta::where('id', $id)->first();
            $molde->nombre = $plantilla;
            $molde->save();
    
            $ruletas = $request->input('ruleta');
            
            PlantillaRuletaRuleta::where('plantilla_ruleta_id', $molde->id)->delete();

            foreach ($ruletas as $ruleta_id) {
                PlantillaRuletaRuleta::create([
                    'plantilla_ruleta_id' => $molde->id,
                    'ruleta_id' => $ruleta_id,
                ]);
            }
    
            return redirect('/plantilla-de-ruletas')->with('success', 'Plantilla Actualizada Exitosamente!');
        }else{
            return redirect('/plantilla-de-ruletas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = PlantillaRuleta::where('id', $id)->count();
        if($count>0){
            
            PlantillaRuleta::where('id', $id)->delete();
            PlantillaRuletaRuleta::where('plantilla_ruleta_id', $id)->delete();

            return redirect('/plantilla-de-ruletas')->with('success', 'Plantilla de Ruleta Eliminada Exitosamente!');
        }else{
            return redirect('/plantilla-de-ruletas')->with('Error', 'Problemas para visualizar el registro');
        }
    }
}
