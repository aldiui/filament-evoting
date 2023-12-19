<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calons', function (Blueprint $table) {
            $table->id();
            $table->integer('no_paslon');
            $table->unsignedBigInteger('ketua_id');
            $table->unsignedBigInteger('wakil_id');
            $table->unsignedBigInteger('agenda_id');
            $table->string('visi');
            $table->text('misi');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('ketua_id')->references('id')->on('users');
            $table->foreign('wakil_id')->references('id')->on('users');
            $table->foreign('agenda_id')->references('id')->on('agendas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calons');
    }
};