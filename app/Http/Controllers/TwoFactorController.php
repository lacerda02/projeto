<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwoFactorCode;

class TwoFactorController extends Controller
{
    public function enable(Request $request)
    {
        $user = auth()->user();
        $user->generateTwoFactorSecret();
    
        // Opcional: Retorne um QR code que pode ser escaneado no Google Authenticator.
        return response()->json([
            'qr_code_url' => (new Google2FA)->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $user->two_factor_secret
            )
        ]);
    }
    public function showForm()
{
    return view('auth.verify');
}

public function verifyCode(Request $request)
{
    // Validar o código
    $request->validate([
        'code' => 'required|string|size:6',
    ]);

    // Recuperar o código do banco e verificar se não expirou
    $codeRecord = TwoFactorCode::where('code', $request->input('code'))
                               ->where('user_id', $request->user()->id)
                               ->where('expires_at', '>', now()) // Verifica a expiração
                               ->first();

    // Verifica se o código é válido
    if (!$codeRecord) {
        return back()->withErrors(['code' => 'Verificação bem-sucedida! Você pode fazer login agora.']);
    }

    // Código válido, autentica o usuário
    $request->user()->update(['two_factor_authenticated' => true]);

    // Mensagem de sucesso e redirecionamento para a tela de login
    return redirect()->route('login')->with('success', 'Verificação bem-sucedida! Você pode fazer login agora.');
}


    
}
