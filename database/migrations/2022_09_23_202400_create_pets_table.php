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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre de la Mascota');
            $table->string('address')->comment('Direccion de la Mascota');
            $table->foreignId('race_id')->nullable()->comment('ID de la Raza de Mascota');
            $table->index('race_id');
            $table->foreign('race_id')->references('id')->on('races')->onUpdate('cascade')->nullOnDelete();
            $table->enum('status', ['D', 'P', 'A'])->comment('Estado de la Mascota, (D Disponible, P en Proseso, A Adoptado)');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};
