<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Rol::all();
        return view("admin.roles.show")->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rol = new Rol();
        return view('admin.roles.create', compact('rol'));
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
            'nombre' => 'required|unique:rols',
        ]);

        if($validator->fails()){
            return redirect()->route('roles.create')->withErrors($validator)->withInput();
        }

        $datoToken = request()->except('_token');
        $rol = Rol::create([
            'nombre' => $request['nombre'],
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Rol created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $rol = Rol::findOrFail($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|unique:rols,nombre,'.$id,
        ]);

        if($validator->fails()){
            return redirect()->route('roles.edit',$id)->withErrors($validator)->withInput();
        }

        $datoToken = request()->except(['_token','_method']);
        $rol = Rol::where('id','=',$id)->update([
            'nombre' => $request['nombre'],
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Rol updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rol = Rol::find($id)->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol deleted successfully.');
    }
}
