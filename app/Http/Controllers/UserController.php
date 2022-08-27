<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Mail\Registro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->id == 1){
            $usuarios = User::all();

        }else{
            $usuarios = User::where('created_by', Auth::user()->id)->get();
        }
        return view("admin.usuarios.show")->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = new User();
        $rols = Rol::pluck('nombre','id');
        return view('admin.usuarios.create', compact('user', 'rols'));
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
        //request()->validate(User::$rules);
        

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'surnames' => 'required|string|max:100',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:10',
            'email' => 'required|email|unique:users',
            'empresa' => 'required|unique:users',
            'rol_id' => 'required',
            //'email' => ['required|email', Rule::unique('users')->ignore($id)],
            //'empresa' => ['required', Rule::unique('users')->ignore($id)],
        ]);
        if ($validator->fails()) {
            return redirect()->route('usuarios.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoUsuario = request()->except('_token');
        
        switch ($request['rol_id']) {
            case 1:
            case 2:
                $usuario = User::create([
                    'name' => $request['name'],
                    'surnames' => $request['surnames'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'phone' => $request['phone'],
                    'empresa' => $request['empresa'],
                    'rol_id' => $request['rol_id'],
                    'created_by' => Auth::user()->id,
                ]);
                break;
            case 3:
                $usuario = User::create([
                    'name' => $request['name'],
                    'surnames' => $request['surnames'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'phone' => $request['phone'],
                    'empresa' => Auth::user()->empresa.'-'.$request['empresa'],
                    'rol_id' => $request['rol_id'],
                    'created_by' => Auth::user()->id,
                ]);
                break;
            default:
                break;
        }
        
        Mail::to($usuario->email)->send(new Registro($usuario));
        
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $usuario = User::findOrFail($id);

        return view('admin.usuarios.user', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuario = User::findOrFail($id);
        $rols = Rol::pluck('nombre','id');        

        return view('admin.usuarios.edit', compact('usuario', 'rols'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'surnames' => 'required|string|max:100',
            'password' => 'sometimes',
            'phone' => 'required|string|min:10',
            'email' => 'required|sometimes|email|unique:users,email,'.$id,
            'empresa' => 'required|sometimes||unique:users,empresa,'.$id,
            //'email' => ['required|email', Rule::unique('users')->ignore($id)],
            //'empresa' => ['required', Rule::unique('users')->ignore($id)],
            'rol_id' => 'sometimes|required',
        ]);
        if ($validator->fails()) {
            if($id == Auth::user()->id){
                return redirect()->route('usuarios.show',$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                return redirect()->route('usuarios.edit',$id)
                ->withErrors($validator)
                ->withInput();
            }
            
        }
        $datoUsuario = request()->except(['_token','_method']);



        if ($id == Auth::user()->id) {
            if ($request['password'] == '') {
                $usuario = User::where('id', '=', $id)->update([
                    'name' => $request['name'],
                    'surnames' => $request['surnames'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                ]);
            } else {
                $usuario = User::where('id', '=', $id)->update([
                    'name' => $request['name'],
                    'surnames' => $request['surnames'],
                    'password' => Hash::make($request['password']),
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                ]);
            }

            return redirect()->to('admin')
                ->with('success', 'Usuario updated successfully.');
        } else {
            $usuario = User::where('id', '=', $id)->update([
                'name' => $request['name'],
                'surnames' => $request['surnames'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'empresa' => $request['empresa'],
                'rol_id' => $request['rol_id'],
            ]);

            return redirect()->route('usuarios.index')
            ->with('success', 'Usuario updated successfully.');
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
        $user = User::find($id)->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario deleted successfully.');
    }
}
