<?php

namespace App\Http\Controllers;
use App\Models\Anonymous;
use Illuminate\Http\Request;

class AnonymousController extends Controller
{
    public function index()
    {
        // Lógica para exibir uma lista de relatórios
        $reports = Anonymous::all();
        return view('anonymous.index', ['reports' => $reports]); // Passar $reports diretamente como um array associativo
    }
}
