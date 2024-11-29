<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anonymous extends Model
{
    use HasFactory;

    protected $table = 'anonymous'; // Nome da tabela
   

    protected $fillable = [
         'type', 'description',
         'anexo'
    ];

    // Se necessário, adicione relacionamentos, mutadores, acessadores ou outros métodos aqui
}


