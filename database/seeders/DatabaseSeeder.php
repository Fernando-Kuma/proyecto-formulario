<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table("rols")->insert(["nombre" => "Root"]);
        DB::table("rols")->insert(["nombre" => "Admin"]);
        DB::table("rols")->insert(["nombre" => "User"]);

        DB::table("users")->insert([
                "name" => "Fernando",
                "surnames" => "Galindo",
                "email" => "fernando998@outlook.es",
                "password" => bcrypt("fernando998"),
                "phone" => "5555555555",
                "empresa" => 'Administrador',
                "Rol_id" => 1,
            ]);
        
        DB::table('eventos')->insert(["nombre" => "Prueba", "empresa" => "Administrador", "created_by" => 1]);
            
        DB::table('menus')->insert(["icono"=> "fa-users", "nombre" => "Usuarios", "estatus" => true, "created_by" => 1 ]);
        DB::table('menus')->insert(["icono"=> "fa-address-card", "nombre" => "Registros", "estatus" => true, "created_by" => 1]);
        DB::table('menus')->insert(["icono"=> "fa-file-signature", "nombre" => "Formulario", "estatus" => true, "created_by" => 1]);
        DB::table('menus')->insert(["icono"=> "fa-newspaper", "nombre" => "Contenido", "estatus" => true, "created_by" => 1]);
        DB::table('menus')->insert(["icono"=> "fa-list", "nombre" => "Respuestas", "estatus" => true, "created_by" => 1]);
        DB::table('menus')->insert(["icono"=> "fa-bars", "nombre" => "Menus", "estatus" => true, "created_by" => 1]);
        DB::table('menus')->insert(["icono"=> "fa-wrench", "nombre" => "Accesos", "estatus" => true, "created_by" => 1]);
        

        DB::table('accesos')->insert(["rol" => 1, "menu" => 1, "estatus" => true, "created_by" => 1]);
        DB::table('accesos')->insert(["rol" => 1, "menu" => 2, "estatus" => true, "created_by" => 1]);
        DB::table('accesos')->insert(["rol" => 1, "menu" => 3, "estatus" => true, "created_by" => 1]);
        DB::table('accesos')->insert(["rol" => 1, "menu" => 4, "estatus" => true, "created_by" => 1]);
        DB::table('accesos')->insert(["rol" => 1, "menu" => 5, "estatus" => true, "created_by" => 1]);
        DB::table('accesos')->insert(["rol" => 1, "menu" => 6, "estatus" => true, "created_by" => 1]);
        DB::table('accesos')->insert(["rol" => 1, "menu" => 7, "estatus" => true, "created_by" => 1]);

        DB::table('respuestas')->insert(["nombre" => "Texto", "tipo" => "text", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Telefono", "tipo" => "tel", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Contraseña", "tipo" => "password", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Email", "tipo" => "email", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Archivo", "tipo" => "file", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Numero", "tipo" => "number", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Rango", "tipo" => "range", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Direccion URL", "tipo" => "url", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Fecha", "tipo" => "date", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Tiempo", "tipo" => "time", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Fecha y hora", "tipo" => "datetime-local", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Color", "tipo" => "color", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Caja", "tipo" => "checkbox", "created_by" => 1]);
        DB::table('respuestas')->insert(["nombre" => "Selecion", "tipo" => "radio", "created_by" => 1]);

        DB::table('formularios')->insert(["evento" => 1, "pregunta" => "Nombre (s)", "respuesta" => 1, "created_by" => 1]);
        DB::table('formularios')->insert(["evento" => 1, "pregunta" => "Apellidos", "respuesta" => 1, "created_by" => 1]);
        DB::table('formularios')->insert(["evento" => 1, "pregunta" => "Correo", "respuesta" => 4, "created_by" => 1]);
        DB::table('formularios')->insert(["evento" => 1, "pregunta" => "Telefono", "respuesta" => 2, "created_by" => 1]);



    }
}
