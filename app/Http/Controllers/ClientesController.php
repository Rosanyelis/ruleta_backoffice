<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Responsable;
use App\Models\Taquilla;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('clientes')
                        ->leftjoin('personas', 'clientes.persona_id', '=' ,'personas.id')
                        ->select('clientes.id as id', 'personas.nombre as nombre', 'personas.apellido as apellido', 'clientes.estatus as estatus')
                        ->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsables = DB::table('responsables')
                            ->leftjoin('personas', 'responsables.persona_id', '=' ,'personas.id')
                            ->select('responsables.id as id', 'personas.nombre as nombre', 'personas.apellido as apellido', 'responsables.rif as rif')
                            ->get();

        return view('clientes.create', compact('responsables'));
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
            'responsable_id' => ['required', 'uuid'],
            'nombre' => ['required', 'max:50'],
            'apellido' => ['required', 'max:50'],
            'sexo' => ['required'],
            'direccion' => ['required', 'max:150'],
            'sector' => ['required', 'max:150'],
        ],[
            'responsable_id.required' => 'El valor del campo Responsable es obligatorio.',
            'responsable_id.uuid' => 'El valor UUID del campo Responsable debe ser válido.',
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

        $responsable = $request->input('responsable_id');
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
        
        $id = $personas->id;
        # crear responsable
        $dato = New Cliente;
        $dato->persona_id = $id;
        $dato->responsable_id = $responsable;
        $dato->direccion = $direccion;
        $dato->sector = $sector;
        $dato->save();

        return redirect('/clientes')->with('success', 'Nuevo Cliente Guardado Exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $count = Cliente::where('id', $id)->count();
        if($count>0){

            $id = $id;

            $cliente = DB::table('clientes')
                    ->leftjoin('personas', 'clientes.persona_id', '=' ,'personas.id')
                    ->where('clientes.id', $id)
                    ->first();
            
            $taquilleros = DB::table('taquillas')
                    ->leftjoin('personas', 'taquillas.persona_id', '=' ,'personas.id')
                    ->where('taquillas.cliente_id', $id)
                    ->get();

            $responsable = Responsable::where('id', $cliente->responsable_id)->first();
  
            $usuario = Usuario::where('cliente_id', $id)->first();

            return view('clientes.show', compact('cliente', 'taquilleros', 'responsable', 'usuario', 'id'));
        }else{
            return redirect('/clientes')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Cliente::where('id', $id)->count();
        if($count>0){

            $responsables = DB::table('responsables')
                            ->leftjoin('personas', 'responsables.persona_id', '=' ,'personas.id')
                            ->select('responsables.id as id', 'personas.nombre as nombre', 'personas.apellido as apellido', 'responsables.rif as rif')
                            ->get();
            
            $cliente = Cliente::where('id', $id)->first();
            
            return view('clientes.edit', compact('responsables', 'cliente'));
        }else{
            return redirect('/clientes')->with('Error', 'Problemas para visualizar el registro');
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
        $count = Cliente::where('id', $id)->count();
        if($count>0){
            $request->validate([
                'responsable_id' => ['required', 'uuid'],
                'nombre' => ['required', 'max:50'],
                'apellido' => ['required', 'max:50'],
                'sexo' => ['required'],
                'direccion' => ['required', 'max:150'],
                'sector' => ['required', 'max:150'],
            ],[
                'responsable_id.required' => 'El valor del campo Responsable es obligatorio.',
                'responsable_id.uuid' => 'El valor UUID del campo Responsable debe ser válido.',
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

            $responsable = $request->input('responsable_id');
            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $sexo = $request->input('sexo');
            $direccion = $request->input('direccion');
            $sector = $request->input('sector');
            
            # Editar persona
            $personas = Persona::where('id', $request->input('persona_id'))->first();;
            $personas->nombre = $nombre;
            $personas->apellido = $apellido;
            $personas->sexo = $sexo;
            $personas->save();
            
            # Editar responsable
            $dato = Cliente::where('id', $id)->first();
            $dato->responsable_id = $responsable;
            $dato->direccion = $direccion;
            $dato->sector = $sector;
            $dato->save();

            return redirect('/clientes')->with('success', 'Cliente Actualizado Exitosamente!');

        }else{
            return redirect('/clientes')->with('Error', 'Problemas para visualizar el registro');
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
    public function asignar($id)
    {
        return view('clientes.usuario.usuarioview', compact('id'));
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
        $usuario->cliente_id = $id;
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        $usuario->password = Hash::make($password);
        $usuario->rol = $rol;
        $usuario->save();

        return redirect('/clientes/'.$id.'/ver-perfil-de-cliente')->with('success', 'Usuario Asignado Exitosamente!');
        
    }

    /**
     * Crear Taquilla
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function taquilla($id)
    {
        return view('clientes.taquilla.taquillaview', compact('id'));
    }

    /**
     * Guardar usuario de responsable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardartaquilla(Request $request, $id){
        
        $request->validate([
            'nombre' => ['required', 'max:50'],
            'apellido' => ['required', 'max:50'],
            'sexo' => ['required'],
            'direccion' => ['required', 'max:150'],
            'telefono' => ['required', 'max:12'],
            'codigo' => ['required', 'max:12'],
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
            'telefono.required' => 'El valor del campo Teléfono es obligatorio.',
            'telefono.max' => [
                'numeric' => 'El campo Teléfono no debe ser mayor a :max.',
                'file'    => 'El archivo Teléfono no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Teléfono no debe contener más de :max caracteres.',
                'array'   => 'El campo Teléfono no debe contener más de :max elementos.',
            ],
            'codigo.required' => 'El valor del campo Código es obligatorio.',
            'codigo.max' => [
                'numeric' => 'El campo Código no debe ser mayor a :max.',
                'file'    => 'El archivo Código no debe pesar más de :max kilobytes.',
                'string'  => 'El campo Código no debe contener más de :max caracteres.',
                'array'   => 'El campo Código no debe contener más de :max elementos.',
            ],
        ]);

        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $sexo = $request->input('sexo');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        $codigo = $request->input('codigo');
        
        # Editar persona
        $personas = new Persona;
        $personas->nombre = $nombre;
        $personas->apellido = $apellido;
        $personas->sexo = $sexo;
        $personas->save();
        
        # Editar responsable
        $dato = new Taquilla;
        $dato->persona_id = $personas->id;
        $dato->cliente_id = $id;
        $dato->codigo = $codigo;
        $dato->direccion = $direccion;
        $dato->telefono = $telefono;
        $dato->save();

        return redirect('/clientes/'.$id.'/ver-perfil-de-cliente')->with('success', 'Taquilla Creada Exitosamente!');
        
    }
}
