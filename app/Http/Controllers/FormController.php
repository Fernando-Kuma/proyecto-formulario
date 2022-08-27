<?php

namespace App\Http\Controllers;

use App\Mail\Enviar;
use App\Models\Contenido;
use App\Models\Evento;
use App\Models\Registro;
use Illuminate\Support\Facades\Mail;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    //
    public function index($id, $company, $event)
    {
        //
        //return response()->json(['dato' => $evento]);
        //$menus = Menu::all();
        $evento = Evento::findOrFail($id);
        $registro = new Registro();
        if(strtolower($evento->nombre) == $event){
            return view("form.registro")->with(compact('evento', 'registro'));
        }
        return abort(404);
    }

    public function store(Request $request, $id, $company, $event)
    {
        //
        $evento = Evento::findOrFail($id);
        $contenido = Contenido::where('evento', $id)->first();
        $validator = Validator::make($request->all(), [
            'registro.*' => 'required',
        ]);
        if ($validator->fails()) {
            $registro = new Registro();
            return redirect()->view("form.registro")->with(compact('evento', 'registro'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $datoToken = request()->except('_token');
        $solicitud = Solicitud::create([
            'evento' => $id,
        ]);
        $enviar = 0;
        if($contenido->mostrar_correo == 1){
            $enviar = 1;
        }
        foreach ($request->input('registro', []) as $i => $nombre) {
            Registro::create([
                'titulo' => $request['pregunta'][$i],
                'respuesta' => $request['registro'][$i],
                'origen' => $solicitud->id,                
            ]);    
            if((filter_var($request['registro'][$i], FILTER_VALIDATE_EMAIL)) && $enviar == 1){
                Mail::to($request['registro'][$i])->send(new Enviar($evento));
                $enviar = 2;
            }      
        }     

        return view("form.confirmacion")->with(compact('evento'));

    }

}
