<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();  // ID auto-incrementado
            $table->string('title');  // Coluna para o título do upload
            $table->text('description')->nullable();  // Coluna para a descrição (opcional)
            $table->string('image');  // Nome da imagem
            $table->string('image_path');  // Caminho da imagem armazenada
            $table->timestamps();  // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
