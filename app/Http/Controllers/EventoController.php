<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::all();
        return view("admin.eventos.show")->with(compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $evento = new Evento();
        return view('admin.eventos.create', compact('evento'));
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
            'nombre' => 'required|unique:eventos',
        ]);

        if($validator->fails()){
            return redirect()->route('eventos.create')->withErrors($validator)->withInput();
        }

        $datoToken = request()->except('_token');
        $evento = Evento::create([
            'nombre' => $request['nombre'],
            'empresa' => Auth::user()->empresa,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $evento = Evento::findOrFail($id);
        return view('admin.eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|unique:eventos,nombre,'.$id,
        ]);

        if($validator->fails()){
            return redirect()->route('eventos.edit',$id)->withErrors($validator)->withInput();
        }

        $datoToken = request()->except(['_token','_method']);
        $evento = Evento::where('id','=',$id)->update([
            'nombre' => $request['nombre']
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response 
     */
    public function destroy($id)
    {
        //
        $evento = Evento::find($id)->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento deleted successfully.');
    }
}
