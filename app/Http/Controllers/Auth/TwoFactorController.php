<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;
use App\Models\TwoFactorCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $user = $request->user(); // Recupera o usuário autenticado

        // Gera um código aleatório de 6 dígitos
        $code = rand(100000, 999999);

        // Define a expiração do código para 10 minutos
        $expiresAt = now()->addMinutes(10);

        // Armazena o código no banco de dados
        TwoFactorCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => $expiresAt
        ]);

        // Envia o código por e-mail (exemplo)
        Mail::to($user->email)->send(new TwoFactorVerificationMail($code));

        return response()->json(['message' => 'Código de verificação enviado.']);
    }
}
