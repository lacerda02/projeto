<?php

namespace App\Http\Controllers;

use App\Models\Anonymous;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de denúncias anônimas
        $totalDenunciasAnonimas = Anonymous::where('id', true)->count();

        // Total de denúncias fáceis (exemplo com uma coluna is_facil)
        $totalDenunciasFacil = Report::where('id', true)->count();

        // Total de usuários
        $totalUsuarios = User::count();

        // Passar os dados para a view
        return view('dashboard', compact('totalDenunciasAnonimas', 'totalDenunciasFacil', 'totalUsuarios'));
    }
}
