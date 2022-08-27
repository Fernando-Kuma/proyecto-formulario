<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class ContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $contenidos = Contenido::all();
        return view("admin.contenidos.show")->with(compact('contenidos'));
        */
        $eventos = Evento::where('created_by', Auth::user()->id)->get();
        return view("admin.contenidos.show")->with(compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        
        $contenido = new Contenido();
        $eventos = Evento::where('created_by', Auth::user()->id)->get();
        $estatus = null;
        return view('admin.contenidos.create', compact('contenido', 'eventos', 'estatus'));
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
            'evento'  => 'required|unique:contenidos',
            'img_fondo' => 'required|max:10000|mimes:jpeg,png,jpg',
            'img_logo' => 'required|max:10000|mimes:jpeg,png,jpg',
            'texto_inicial' => 'required',
            'texto_final' => 'required',
            'color_fondo' => 'required',
            'color_texto' => 'required',
        ]);
        
        

        $texto_correo = null;
        $estatus = false; 
        $evento = Evento::find($request['evento']);
        foreach ($evento->formularios as $formulario) {
            if($formulario->respuestas->tipo == 'email' && $request['mostrar_correo'] == "true"){
                $estatus = true; 
                $validator = Validator::make($request->all(),[
                    'texto_correo' => 'required'
                ]);
                $texto_correo = $request['texto_correo'];
            }
        }

        if($validator->fails()){
            return redirect()->route('contenido.create')->withErrors($validator)->withInput();
        }

        $img_fondo=$request->file('img_fondo')->store('uploads','public');
        $img_logo=$request->file('img_logo')->store('uploads','public');
        
        $datoToken = request()->except('_token');
        $contenido = Contenido::create([
            'evento' => $request['evento'],
            'img_fondo' => $img_fondo,
            'img_logo' => $img_logo,
            'mostrar_correo' => $estatus,
            'texto_inicial' => $request['texto_inicial'],
            'texto_final' => $request['texto_final'],
            'texto_correo' => $texto_correo,
            'color_fondo' => $request['color_fondo'],
            'color_texto' => $request['color_texto'],
            'correo' => Auth::user()->email,
            'created_by' => Auth::user()->id,
        ]);
        return redirect()->route('contenido.index')
            ->with('success', 'Contenido created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function show(Contenido $contenido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contenido = Contenido::findOrFail($id);
        $eventos = Evento::where('created_by', Auth::user()->id)->get();
        $estatus = null;
        if($contenido->mostrar_correo == 1){
            $estatus = $contenido->mostrar_correo;
        }

        return view('admin.contenidos.edit', compact('contenido', 'eventos', 'estatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'evento' => 'required|unique:contenidos,evento,'.$id,
            'texto_inicial' => 'required',
            'texto_final' => 'required',
            'color_fondo' => 'required',
            'color_texto' => 'required',
        ]);
        $correo_estatus = false;
        $texto_correo = null;
        $evento = Evento::find($request['evento']);
        foreach ($evento->formularios as $formulario) {
            if($formulario->respuestas->tipo == 'email' && $request['mostrar_correo'] == "true"){
                $validator = Validator::make($request->all(),[
                    'texto_correo' => 'required'
                ]);
                $correo_estatus = true; 
                $texto_correo = $request['texto_correo'];
            }
        }
        if($request->hasFile('img_fondo')){
            $validator = Validator::make($request->all(),[
                'img_fondo' => 'required|max:10000|mimes:jpeg,png,jpg',
            ]);
        }
        if($request->hasFile('img_logo')){
            $validator = Validator::make($request->all(),[
                'img_logo' => 'required|max:10000|mimes:jpeg,png,jpg',
            ]);
        }
        
        if($validator->fails()){
            return redirect()->route('contenido.edit',$id)->withErrors($validator)->withInput();
        }

        $datoToken = request()->except(['_token','_method']);

        $contenido = Contenido::findOrFail($id);
        if($request->hasFile('img_fondo')){
            if($request->hasFile('img_logo')){
                Storage::delete('public/'.$contenido->img_fondo);
                Storage::delete('public/'.$contenido->img_logo);
                $img_fondo=$request->file('img_fondo')->store('uploads','public');
                $img_logo=$request->file('img_logo')->store('uploads','public');
            }else{
                Storage::delete('public/'.$contenido->img_fondo);
                $img_fondo=$request->file('img_fondo')->store('uploads','public');
                $img_logo=$contenido->img_logo;
            }
        }else if($request->hasFile('img_logo')){
            Storage::delete('public/'.$contenido->img_logo);
            $img_logo=$request->file('img_logo')->store('uploads','public');
            $img_fondo=$contenido->img_fondo;
        } else {
            $img_fondo=$contenido->img_fondo;
            $img_logo=$contenido->img_logo;
        }

        Contenido::where('id','=',$id)->update([
            'evento' => $request['evento'],
            'img_fondo' => $img_fondo,
            'img_logo' => $img_logo,
            'mostrar_correo' => $correo_estatus,
            'texto_inicial' => $request['texto_inicial'],
            'texto_final' => $request['texto_final'],
            'texto_correo' => $texto_correo,
            'color_fondo' => $request['color_fondo'],
            'color_texto' => $request['color_texto'],
        ]);

        return redirect()->route('contenido.index')
            ->with('success', 'Contenido updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //se busca los datos del id
        $contenido =Contenido::findOrFail($id);
        //se condiciona para eliminar foto
        if(Storage::delete('public/'.$contenido->img_fondo && 'public/'.$contenido->img_logo)){
            //Se destruye los datos en la base de datos
            Contenido::destroy($id);
            return redirect()->route('contenido.index')
                ->with('success', 'Contenido deleted successfully.');
        }   
        return redirect()->route('contenido.index')
                ->with('danger', 'Fallo');
    }
}
