<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TwoFactorCodeMail;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Para onde redirecionar os usuários após o registro.
     */
    protected $redirectTo = '/verify-two-factor';

    /**
     * Valida a solicitação de registro.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Gera e envia o código de verificação 2FA para o e-mail do usuário.
     *
     * @param User $user
     */
    protected function sendTwoFactorCode(User $user)
    {
        // Gerar o código de verificação (número de 6 dígitos)
        $verificationCode = rand(100000, 999999);

        // Atualizar o modelo do usuário com o código e data de expiração
        $user->update([
            'two_factor_code' => $verificationCode,
            'two_factor_expires_at' => now()->addMinutes(10), // Expira em 10 minutos
        ]);

        // Enviar o código de verificação por e-mail
        Mail::to($user->email)->send(new TwoFactorCodeMail($verificationCode));
    }

    /**
     * Cria o usuário e inicia o processo de verificação 2FA.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        // Criar o usuário com status inativo para impedir login antes da verificação
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => false, // Conta inativa até que o código seja verificado
        ]);

        // Enviar o código de verificação 2FA
        $this->sendTwoFactorCode($user);

        return $user;
    }

    /**
     * Redireciona o usuário para a tela de verificação após o registro.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->route('verify.two.factor', ['email' => $user->email]);
    }

    /**
     * Exibe o formulário de verificação de dois fatores.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showVerifyForm(Request $request)
    {
        // Recuperar o e-mail do usuário, passado como parâmetro na URL
        $email = $request->input('email');

        // Verificar se o usuário existe
        $user = User::where('email', $email)->first();

        // Se o usuário não existe ou não tem um código de verificação válido, redirecionar de volta para a página de registro
        if (!$user || !$user->two_factor_code || $user->two_factor_expires_at < now()) {
            return redirect()->route('register')->with('error', 'Código de verificação expirado ou inválido.');
        }

        // Exibir a página de verificação com o e-mail do usuário
        return view('auth.verify', ['email' => $email]);
    }
}
