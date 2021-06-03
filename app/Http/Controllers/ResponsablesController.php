<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResponsablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsables = DB::table('responsables')
                            ->leftjoin('personas', 'responsables.persona_id', '=' ,'personas.id')
                            ->select('responsables.id as id', 'personas.nombre as nombre', 'personas.apellido as apellido', 'responsables.rif as rif', 'responsables.estatus as estatus')
                            ->get();
        return view('responsables.index', compact('responsables'));
        // return $responsables;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('responsables.create');
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
            'nombre' => ['required', 'max:50'],
            'apellido' => ['required', 'max:50'],
            'sexo' => ['required'],
            'rif' => ['required', 'max:10', 'unique:responsables,rif'],
            'direccion' => ['required', 'max:150'],
        ],[
            'nombre.required' => 'El valor del campo Nombres es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombres no debe ser mayor a :max.',
                'file'    => 'El archivo Nombres no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombres no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombres no debe contener más de :max elementos.',
            ],
            'apellido.required' => 'El valor del campo Apellidos es obligatorio.',
            'apellido.max' => [
                'numeric' => 'El campo Apellidos no debe ser mayor a :max.',
                'file'    => 'El archivo Apellidos no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Apellidos no debe contener más de :max caracteres.',
                'array'   => 'El campo Apellidos no debe contener más de :max elementos.',
            ],
            'rif.required' => 'El valor del campo Rif es obligatorio.',
            'rif.max' => [
                'numeric' => 'El campo Rif no debe ser mayor a :max.',
                'file'    => 'El archivo Rif no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Rif no debe contener más de :max caracteres.',
                'array'   => 'El campo Rif no debe contener más de :max elementos.',
            ],
            'sexo.required' => 'El valor del campo Sexo es obligatorio.',
            'sexo.max' => [
                'numeric' => 'El campo Sexo no debe ser mayor a :max.',
                'file'    => 'El archivo Sexo no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Sexo no debe contener más de :max caracteres.',
                'array'   => 'El campo Sexo no debe contener más de :max elementos.',
            ],
            'direccion.required' => 'El valor del campo Dirección es obligatorio.',
            'direccion.max' => [
                'numeric' => 'El campo Dirección de Usuario no debe ser mayor a :max.',
                'file'    => 'El archivo Dirección de Usuario no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Dirección de Usuario no debe contener más de :max caracteres.',
                'array'   => 'El campo Dirección de Usuario no debe contener más de :max elementos.',
            ],
            
        ]);

        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $sexo = $request->input('sexo');
        $rif = $request->input('rif');
        $direccion = $request->input('direccion');
        
        # crear persona
        $personas = New Persona;
        $personas->usuario_id = null;
        $personas->nombre = $nombre;
        $personas->apellido = $apellido;
        $personas->sexo = $sexo;
        $personas->save();
        
        $id = $personas->id;
        # crear responsable
        $dato = New Responsable;
        $dato->persona_id = $id;
        $dato->usuario_id = null;
        $dato->rif = $rif;
        $dato->direccion = $direccion;
        $dato->save();

        return redirect('/responsables')->with('success', 'Nuevo Responsable Guardado Exitosamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = DB::table('responsables')->where('id', $id)->count();
        if($count>0){
            $responsable = DB::table('responsables')
                            ->leftjoin('personas', 'responsables.persona_id', '=' ,'personas.id')
                            ->where('responsables.id', $id)
                            ->first();

            $clientes = DB::table('clientes')
                            ->leftJoin('personas', 'clientes.persona_id', 'personas.id')
                            ->select('clientes.id as id', 'personas.nombre as nombre', 'personas.apellido as apellido')
                            ->where('clientes.responsable_id', $id)
                            ->get();

            $usuario = Usuario::where('responsable_id', $id)->first();

            $id = $id;
            
            return view('responsables.show', compact('responsable', 'clientes', 'usuario', 'id'));
        }else {
            return redirect('/responsables')->with('Error', 'Problemas para visualizar el registro');
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
        $count = DB::table('responsables')->where('id', $id)->count();
        if($count>0){
            $responsable = Responsable::where('id', $id)->first();
            return view('responsables.edit', compact('responsable'));
        }else{
            return redirect('/responsables')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Responsable::where('id', $id)->count();
        if($count>0){
            $request->validate([
                'nombre' => ['required', 'max:50'],
                'apellido' => ['required', 'max:50'],
                'sexo' => ['required'],
                'rif' => ['required', 'max:10'],
                'direccion' => ['required', 'max:150'],
            ],[
                'nombre.required' => 'El valor del campo Nombres es obligatorio.',
                'nombre.max' => [
                    'numeric' => 'El campo Nombres no debe ser mayor a :max.',
                    'file'    => 'El archivo Nombres no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Nombres no debe contener más de :max caracteres.',
                    'array'   => 'El campo Nombres no debe contener más de :max elementos.',
                ],
                'apellido.required' => 'El valor del campo Apellidos es obligatorio.',
                'apellido.max' => [
                    'numeric' => 'El campo Apellidos no debe ser mayor a :max.',
                    'file'    => 'El archivo Apellidos no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Apellidos no debe contener más de :max caracteres.',
                    'array'   => 'El campo Apellidos no debe contener más de :max elementos.',
                ],
                'rif.required' => 'El valor del campo Rif es obligatorio.',
                'rif.max' => [
                    'numeric' => 'El campo Rif no debe ser mayor a :max.',
                    'file'    => 'El archivo Rif no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Rif no debe contener más de :max caracteres.',
                    'array'   => 'El campo Rif no debe contener más de :max elementos.',
                ],
                'sexo.required' => 'El valor del campo Sexo es obligatorio.',
                'sexo.max' => [
                    'numeric' => 'El campo Sexo no debe ser mayor a :max.',
                    'file'    => 'El archivo Sexo no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Sexo no debe contener más de :max caracteres.',
                    'array'   => 'El campo Sexo no debe contener más de :max elementos.',
                ],
                'direccion.required' => 'El valor del campo Dirección es obligatorio.',
                'direccion.max' => [
                    'numeric' => 'El campo Dirección de Usuario no debe ser mayor a :max.',
                    'file'    => 'El archivo Dirección de Usuario no debe pesar más de :max kilobytes.',
                    'string'  => 'El campo Dirección de Usuario no debe contener más de :max caracteres.',
                    'array'   => 'El campo Dirección de Usuario no debe contener más de :max elementos.',
                ],
                
            ]);
            

            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $sexo = $request->input('sexo');
            $rif = $request->input('rif');
            $direccion = $request->input('direccion');
            
            # Editar persona
            $personas = Persona::where('id', $request->input('persona_id'))->first();
            $personas->nombre = $nombre;
            $personas->apellido = $apellido;
            $personas->sexo = $sexo;
            $personas->save();
            
            # Editar Responsable
            $dato = Responsable::where('id', $id)->first();
            $dato->rif = $rif;
            $dato->direccion = $direccion;
            $dato->save();

            return redirect('/responsables')->with('success', 'Responsable Actualizado Exitosamente!');
        }else {
            return redirect('/responsables')->with('Error', 'Problemas para visualizar el registro');
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

    /**
     * Asignar usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function usuario($id)
    {
        $id = $id;
        return view('responsables.usuario.asignar_usuario', compact('id'));
    }

    /**
     * Guardar usuario de responsable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id){
        $request->validate([
            'nombre' => 'required|string|max:15',
            'email' => 'required|string|email|max:200|unique:usuarios',
            'password' => ['required', Rules\Password::min(8)],
        ],[
            'nombre.required' => 'El valor del campo Nombre de Usuario es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombre de Usuario no debe ser mayor a :max.',
                'file'    => 'El archivo Nombre de Usuario no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombre de Usuario no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombre de Usuario no debe contener más de :max elementos.',
            ],
            'email.required' => 'El valor del campo Correo es obligatorio.',
            'email.max' => [
                'numeric' => 'El campo Correo no debe ser mayor a :max.',
                'file'    => 'El archivo Correo no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Correo no debe contener más de :max caracteres.',
                'array'   => 'El campo Correo no debe contener más de :max elementos.',
            ],
            'password.required' => 'El valor del campo Contraseña es obligatorio.',

        ]);


        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $password = $request->input('password');
        $rol = $request->input('rol');

        $usuario = new Usuario;
        $usuario->responsable_id = $id;
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        $usuario->password = Hash::make($password);
        $usuario->rol = $rol;
        $usuario->save();

        return redirect('/responsables/'.$id.'/ver-perfil-de-responsable')->with('success', 'Usuario Asignado Exitosamente!');
        
    }

    /**
     * Crear nuevo cliente
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cliente($id)
    {
        return view('responsables.cliente.crear_cliente', compact('id'));
    }

    /**
     * Guardar usuario de responsable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardarCliente(Request $request, $id){

        $request->validate([
            'nombre' => ['required', 'max:50'],
            'apellido' => ['required', 'max:50'],
            'sexo' => ['required'],
            'direccion' => ['required', 'max:150'],
            'sector' => ['required', 'max:150'],
        ],[
            'nombre.required' => 'El valor del campo Nombres es obligatorio.',
            'nombre.max' => [
                'numeric' => 'El campo Nombres no debe ser mayor a :max.',
                'file'    => 'El archivo Nombres no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Nombres no debe contener más de :max caracteres.',
                'array'   => 'El campo Nombres no debe contener más de :max elementos.',
            ],
            'apellido.required' => 'El valor del campo Apellidos es obligatorio.',
            'apellido.max' => [
                'numeric' => 'El campo Apellidos no debe ser mayor a :max.',
                'file'    => 'El archivo Apellidos no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Apellidos no debe contener más de :max caracteres.',
                'array'   => 'El campo Apellidos no debe contener más de :max elementos.',
            ],
            'sexo.required' => 'El valor del campo Sexo es obligatorio.',
            'sexo.max' => [
                'numeric' => 'El campo Sexo no debe ser mayor a :max.',
                'file'    => 'El archivo Sexo no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Sexo no debe contener más de :max caracteres.',
                'array'   => 'El campo Sexo no debe contener más de :max elementos.',
            ],
            'direccion.required' => 'El valor del campo Dirección es obligatorio.',
            'direccion.max' => [
                'numeric' => 'El campo Dirección no debe ser mayor a :max.',
                'file'    => 'El archivo Dirección no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Dirección no debe contener más de :max caracteres.',
                'array'   => 'El campo Dirección no debe contener más de :max elementos.',
            ],
            'sector.required' => 'El valor del campo Sector es obligatorio.',
            'sector.max' => [
                'numeric' => 'El campo Sector no debe ser mayor a :max.',
                'file'    => 'El archivo Sector no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Sector no debe contener más de :max caracteres.',
                'array'   => 'El campo Sector no debe contener más de :max elementos.',
            ],
            
        ]);

        $responsable = $id;
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $sexo = $request->input('sexo');
        $direccion = $request->input('direccion');
        $sector = $request->input('sector');
        
        # crear persona
        $personas = New Persona;
        $personas->usuario_id = null;
        $personas->nombre = $nombre;
        $personas->apellido = $apellido;
        $personas->sexo = $sexo;
        $personas->save();
        
        $id_persona = $personas->id;
        # crear responsable
        $dato = New Cliente;
        $dato->persona_id = $id_persona;
        $dato->responsable_id = $responsable;
        $dato->direccion = $direccion;
        $dato->sector = $sector;
        $dato->save();

        return redirect('/responsables/'.$id.'/ver-perfil-de-responsable')->with('success', 'Cliente Creado Exitosamente!');
    }
}
