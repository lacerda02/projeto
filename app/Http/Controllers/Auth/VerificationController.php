<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function showForm()
    {
        return view('auth.verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = User::where('verification_code', $request->code)->first();

        if ($user) {
            // Atualize o status de verificação se necessário
            $user->verification_code = null; // Remove o código
            $user->save();

            // Redirecione para a tela de login
            return redirect()->route('login')->with('success', 'Código verificado com sucesso!');
        }

        return back()->withErrors(['code' => 'Código inválido. Tente novamente.']);
    }
}
