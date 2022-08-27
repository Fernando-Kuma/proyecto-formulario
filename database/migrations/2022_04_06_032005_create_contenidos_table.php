<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidos', function (Blueprint $table) {
            $table->id();
            $table->string('correo');
            $table->string('img_fondo', 2048)->nullable();
            $table->string('img_logo', 2048)->nullable();
            $table->boolean('mostrar_correo');
            $table->longText('texto_inicial');
            $table->longText('texto_final');
            $table->longtext('texto_correo')->nullable();;
            $table->string('color_fondo');
            $table->string('color_texto');
            $table->foreignId('evento')->constrained('eventos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenidos');
    }
};
