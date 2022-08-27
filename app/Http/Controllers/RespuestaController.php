<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $respuestas = Respuesta::all();
        return view("admin.respuestas.show")->with(compact('respuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $respuesta = new Respuesta();
        return view('admin.respuestas.create', compact('respuesta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|unique:respuestas',
            'tipo' => 'required|unique:respuestas',
        ]);

        if($validator->fails()){
            return redirect()->route('respuestas.create')->withErrors($validator)->withInput();
        }

        $datoToken = request()->except('_token');
        $respuesta = Respuesta::create([
            'nombre' => $request['nombre'],
            'tipo' => $request['tipo'],
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('respuestas.index')
            ->with('success', 'Respuesta created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Respuesta $respuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $respuesta = Respuesta::findOrFail($id);
        return view('admin.respuestas.edit', compact('respuesta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|unique:respuestas,nombre,'.$id,
            'tipo' => 'required|unique:respuestas,tipo,'.$id,
        ]);

        if($validator->fails()){
            return redirect()->route('respuestas.edit',$id)->withErrors($validator)->withInput();
        }

        $datoToken = request()->except(['_token','_method']);
        $respuesta = respuesta::where('id','=',$id)->update([
            'nombre' => $request['nombre'],
            'tipo' => $request['tipo'],
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('respuestas.index')
            ->with('success', 'Respuesta updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $respuesta = Respuesta::find($id)->delete();

        return redirect()->route('respuestas.index')
            ->with('success', 'Respuesta deleted successfully.');
    }
}
