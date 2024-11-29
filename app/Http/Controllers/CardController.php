<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function index()
    {
        return response()->json(Card::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        // Armazena a imagem
        $path = $request->file('image')->store('uploads/cards', 'public');

        // Cria o card no banco de dados
        $card = Card::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $path,
        ]);

        return response()->json($card, 201);
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return response()->json(['message' => 'Card excluído com sucesso!'], 200);
    }
}

