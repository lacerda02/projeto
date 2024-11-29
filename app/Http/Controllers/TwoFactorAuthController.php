<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorAuthController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required',
        ]);

        $google2fa = new Google2FA();

        $isValid = $google2fa->verifyKey(
            auth()->user()->two_factor_secret,
            $request->input('two_factor_code')
        );

        if ($isValid) {
            return response()->json(['message' => '2FA verificado com sucesso']);
        }

        return response()->json(['message' => 'Código inválido'], 422);
    }
}
