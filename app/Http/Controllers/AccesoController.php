<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Menu;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accesos = Acceso::all();
        return view("admin.accesos.show")->with(compact('accesos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $acceso = new Acceso();
        $menus = Menu::pluck('nombre','id');
        $rols = Rol::pluck('nombre','id');
        return view('admin.accesos.create', compact('acceso', 'menus', 'rols'));
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
            'rol' => 'required',
            'menu' => 'required',
        ]);
        $estatus = true; 
        if ($request['estatus'] != "true"){ $estatus = false; }

        if($validator->fails()){
            return redirect()->route('accesos.create')->withErrors($validator)->withInput();
        }

        $datoToken = request()->except('_token');
        $acceso = Acceso::create([
            'rol' => $request['rol'],
            'menu' => $request['menu'],
            'estatus' => $estatus,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('accesos.index')
            ->with('success', 'Acceso created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function show(Acceso $acceso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $acceso = Acceso::findOrFail($id);
        $menus = Menu::pluck('nombre','id');
        $rols = Rol::pluck('nombre','id');
        return view('admin.accesos.edit', compact('acceso', 'menus', 'rols'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'rol' => 'required',
            'menu' => 'required',
        ]);
        $estatus = true; 
        if ($request['estatus'] != "true"){ $estatus = false; }

        if($validator->fails()){
            return redirect()->route('accesos.edit',$id)
                ->withErrors($validator)->withInput();
        }

        $datoToken = request()->except(['_token','_method']);
        $acceso = Acceso::where('id','=',$id)->update([
            'rol' => $request['rol'],
            'menu' => $request['menu'],
            'estatus' => $estatus,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('accesos.index')
            ->with('success', 'Acceso updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $acceso = Acceso::find($id)->delete();

        return redirect()->route('accesos.index')
            ->with('success', 'Acceso deleted successfully.');
    }
}
