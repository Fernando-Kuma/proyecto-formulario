<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mensajes = Mensaje::all();
        return view("admin.mensaje.show")->with(compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mensaje = new Mensaje();
        return view('admin.mensaje.create', compact('mensaje'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required',
        ]);
        if($request['paginacion'] == 'admin' && $validator->fails()){
            return redirect()->route('mensaje.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request['paginacion'] == 'usuario' && $validator->fails()){
            return redirect()->view('welcome')
                        ->withErrors($validator)
                        ->withInput();
        }


        
        $datoToken = request()->except('_token');
        $mensaje = Mensaje::create([
            'nombre' => $request['nombre'],
            'correo' => $request['correo'],
            'mensaje' => $request['mensaje'],
        ]);    
        if($request['paginacion'] == 'admin'){
            return view('admin.home')->with('success', 'Mensaje enviado.');   
        }

        if($request['paginacion'] == 'usuario'){
            return view('welcome')->with('success', 'Mensaje enviado.');   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('mensaje.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoToken = request()->except('_token');
        $mensaje = Mensaje::create([
            'nombre' => $request['nombre'],
            'correo' => $request['correo'],
            'mensaje' => $request['mensaje'],
        ]);    
        return view('welcome')->with('success', 'Mensaje enviado.');      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('mensaje.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoToken = request()->except('_token');
        $mensaje = Mensaje::create([
            'nombre' => $request['nombre'],
            'correo' => $request['correo'],
            'mensaje' => $request['mensaje'],
        ]);    
        return view('welcome')->with('success', 'Mensaje enviado.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        //
    }
}
