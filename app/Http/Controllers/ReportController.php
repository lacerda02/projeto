<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        // Lógica para exibir uma lista de relatórios
        $reports = Report::all();
        return view('reports.index', ['reports' => $reports]); // Passar $reports diretamente como um array associativo
    }
    

    public function create()
    {
        // Retorna a view para criar um novo relatório
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anexo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // ajuste para o tamanho máximo desejado
            'description' => ['required', 'string'],
            // adicione outras regras de validação conforme necessário
        ]);
    
        $path = $request->file('anexo')->store('reports', 'public');
    
        $report = new Report();
        $report->type = $request->type;
        $report->description = $request->description;
        $report->number = $request->number;
        $report->anexo = $path;
        $report->save();
    
        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    // Adicione outras funções do controlador conforme necessário
}
