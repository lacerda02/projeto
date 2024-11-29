<?php
// app/Http/Controllers/UploadController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    // Método para exibir a página de upload
    public function index()
    {
        return view('upload.index');  // Exibe a página de upload com o formulário
    }

    // Método para obter todos os uploads como JSON (API)
    public function getUploads()
    {
        $uploads = Upload::all();  // Obtém todos os uploads da tabela
        return response()->json($uploads);  // Retorna os dados como JSON
    }

    // Método para salvar o upload (se necessário)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048', // Limite de 2MB
        ]);

        // Salvar a imagem
        $imagePath = $request->file('image')->store('uploads', 'public');  // Salva a imagem na pasta public/uploads

        // Criar o registro no banco de dados
        $upload = new Upload();
        $upload->title = $validated['title'];
        $upload->description = $validated['description'] ?? '';
        $upload->image = basename($imagePath);  // Armazena apenas o nome do arquivo
        $upload->image_path = $imagePath;
        $upload->save();

        return redirect()->back()->with('success', 'Upload realizado com sucesso!');
    }
}