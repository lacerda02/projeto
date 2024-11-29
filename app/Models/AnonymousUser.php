<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnonymousUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'description'
    ];

    // Se necessário, adicione relacionamentos, mutadores, acessadores ou outros métodos aqui
}
