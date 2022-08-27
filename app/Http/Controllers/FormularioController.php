<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use App\Models\Evento;
use App\Models\Formulario;
use App\Models\Respuesta;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::where('created_by', Auth::user()->id)->get();
        return view("admin.formulario.show")->with(compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $formulario = new Formulario();
        $evento = new Evento();
        $respuestas = Respuesta::pluck('nombre','id');
        return view('admin.formulario.create', compact('formulario', 'evento', 'respuestas'));
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
            'nombre' => 'required|unique:eventos',
            'pregunta.*' => 'required',
            'respuesta.*' => 'required',
            'created_by' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('formulario.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoToken = request()->except('_token');
        $evento = Evento::create([
            'nombre' => $request['nombre'],
            'empresa' => Auth::user()->empresa,
            'created_by' => Auth::user()->id,
        ]);
        foreach ($request->input('pregunta', []) as $i => $nombre) {
            Formulario::create([
                'evento' => $evento->id,
                'pregunta' => $request['pregunta'][$i],
                'respuesta' => $request['respuesta'][$i],
                'created_by' => Auth::user()->id,                
            ]);
        }                   
        return redirect()->route('formulario.index')
            ->with('success', 'Formulario created successfully.');
        /*return response()->json(['dato' => $dato]);*/
            
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $evento = Evento::findOrFail($id);
        $respuestas = Respuesta::pluck('nombre','id');

        return view('admin.formulario.edit', compact('evento', 'respuestas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:eventos,nombre,'.$id,
            'pregunta.*' => 'required',
            'respuesta.*' => 'required',
            'created_by' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('formulario.edit',$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoToken = request()->except(['_token','_method']);

        $evento = Evento::where('id','=',$id)->update([
            'nombre' => $request['nombre'],
            'empresa' => Auth::user()->empresa,
        ]);
        foreach ($request->input('pregunta', []) as $i => $nombre) {
            Formulario::where('id','=',$request['formulario_id'][$i])->update([
                'pregunta' => $request['pregunta'][$i],
                'respuesta' => $request['respuesta'][$i],
            ]);
        }       
        return redirect()->route('formulario.index')
        ->with('success', 'Formulario updated successfully.');
        
        /*
            return response()->json(['dato' => $request['formulario_id']]);
            */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $evento = Evento::find($id)->delete();
        return redirect()->route('formulario.index')
        ->with('success', 'Formulario deleted successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $formulario = Formulario::findOrFail($id);
        Formulario::destroy($id);
        $evento =  Evento::findOrFail($formulario->evento);
        $respuestas = Respuesta::pluck('nombre','id');
        return view('admin.formulario.edit', compact('evento', 'respuestas'));
    }
}
