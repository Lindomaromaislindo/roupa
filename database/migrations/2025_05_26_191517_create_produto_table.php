<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->foreign('colecao_id')->references('id')->on('colecao')->onDelete('cascade');
            $table->unsignedBigInteger('colecao_id');
            $table->string('nome');
            $table->decimal('preco', 8, 2);
            $table->text('descricao');
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
