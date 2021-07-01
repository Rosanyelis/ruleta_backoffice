<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Models\Ruleta;

class RuletasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruletas = Ruleta::all();
        return view('ruletas.index', compact('ruletas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ruletas.create');
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
            'url_imagen' => 'required',
        ],[
            'nombre.required' => 'El valor del campo Nombre de Ruleta es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombre de Ruleta no debe ser mayor a :max.',
                'file'    => 'El archivo Nombre de Ruleta no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombre de Ruleta no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombre de Ruleta no debe contener más de :max elementos.',
            ],
            'url_imagen.required' => 'El valor del campo Imagen de Ruleta es obligatorio.',
        ]);
        
        $nombre = $request->input('nombre');

        $ruleta = new Ruleta;
        $ruleta->nombre = $nombre;

        if ($request->hasFile('url_imagen')) {
            $uploadPath = public_path('/storage/ruletas/');
            $file = $request->file('url_imagen');
            $extension = $file->getClientOriginalExtension();
            $uuid = (string) Uuid::generate(4);
            $fileName = $uuid.'.'.$extension;
            $file->move($uploadPath, $fileName);
            $ruleta->url_imagen = asset('/storage/ruletas/'.$fileName);
        }

        $ruleta->save();

        return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('success', 'Ruleta Creada Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = Ruleta::where('id', $id)->count();
        if($count>0){
            
            $ruletas = Ruleta::where('id', $id)->first();

            return view('ruletas.show', compact('ruletas'));
        }else{
            return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Ruleta::where('id', $id)->count();
        if($count>0){
            
            $ruletas = Ruleta::where('id', $id)->first();

            return view('ruletas.edit', compact('ruletas'));
        }else{
            return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Ruleta::where('id', $id)->count();
        if($count>0){
            
            $request->validate([
                'nombre' => 'required|string|max:35',
            ],[
                'nombre.required' => 'El valor del campo Nombre de Nombre de Ruleta es obligatorio.',
                'nombre.max' => [
                    'numeric' => 'El campo Nombre de Nombre de Ruleta no debe ser mayor a :max.',
                    'file'    => 'El archivo Nombre de Nombre de Ruleta no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Nombre de Nombre de Ruleta no debe contener más de :max caracteres.',
                    'array'   => 'El campo Nombre de Nombre de Ruleta no debe contener más de :max elementos.',
                ],
            ]);
            
            $nombre = $request->input('nombre');
    
            $ruleta = Ruleta::where('id', $id)->first();
            $ruleta->nombre = $nombre;
    
            if ($request->hasFile('url_imagen')) {
                $uploadPath = public_path('/storage/ruletas/');
                $file = $request->file('url_imagen');
                $extension = $file->getClientOriginalExtension();
                $uuid = (string) Uuid::generate(4);
                $fileName = $uuid.'.'.$extension;
                $file->move($uploadPath, $fileName);
                $ruleta->url_imagen = asset('/storage/ruletas/'.$fileName);
            }
    
            $ruleta->save();
    
            return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('success', 'Ruleta Editada Exitosamente!');
        }else{
            return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Ruleta::where('id', $id)->count();
        if($count>0){
            
            Ruleta::where('id', $id)->delete();

            return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('success', 'Ruleta Eliminada Exitosamente!');
        }else{
            return redirect('/plantilla-de-ruletas/configurar-ruletas')->with('Error', 'Problemas para visualizar el registro');
        }
    }
}
