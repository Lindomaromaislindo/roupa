<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colecao', function (Blueprint $table) {
            $table->id();
            $table->string('nome_colecao');
            $table->text('descricao');
            $table->date('data_lancamento');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('colecao');
    }
};
