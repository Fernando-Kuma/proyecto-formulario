<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public static function index()
    {
        //
        $menus = Menu::all();
        return view("admin.menus.show")->with(compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menu = new Menu();
        return view('admin.menus.create', compact('menu'));
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
        $validator = Validator::make($request->all(), [
            'icono' => 'required',
            'nombre' => 'required|unique:menus',
        ]);
        $estatus = true; 
        if ($request['estatus'] != "true"){ $estatus = false; }



        if ($validator->fails()) {
            return redirect()->route('menus.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoMenu = request()->except('_token');
        $menu = Menu::create([
            'icono' => $request['icono'],
            'nombre' => $request['nombre'],
            'estatus' => $estatus,
            'created_by' => Auth::user()->id,
        ]);
    

        return redirect()->route('menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'icono' => 'required',
            'nombre' => 'required|unique:menus,nombre,'.$id,
        ]);
        $estatus = true; 
        if ($request['estatus'] != "true"){ $estatus = false; }

        if ($validator->fails()) {
            return redirect()->route('menus.edit',$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoMenu = request()->except(['_token','_method']);
        $menu = Menu::where('id','=',$id)->update([
            'icono' => $request['icono'],
            'nombre' => $request['nombre'],
            'estatus' => $estatus,
            'created_by' => Auth::user()->id,
        ]);
        return redirect()->route('menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $menu = Menu::find($id)->delete();

        return redirect()->route('menus.index')
            ->with('success', 'Menu deleted successfully.');
    }
}
