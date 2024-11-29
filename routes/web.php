<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TwoFactorCode;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;

// Rota para a página inicial de login
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');

Route::get('/home', HomeController::class)->name('home');
Route::get('movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// Rota para a página do dashboard (somente usuários autenticados e verificados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas que requerem autenticação
Route::middleware('auth')->group(function () {
    // Rotas para o perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Em routes/web.php
// Route::middleware('auth')->group(function () {
//     // Rota para ativar a autenticação de dois fatores
//     Route::post('/enable-2fa', [TwoFactorController::class, 'enable'])->name('enable-2fa');

//     // Rota para exibir o formulário de verificação de dois fatores
//     Route::get('/verify-code', [TwoFactorController::class, 'showForm'])->name('verify-code.form');

//     // Rota para verificar o código inserido no formulário de verificação
//     Route::post('/verify-code', [TwoFactorController::class, 'verifyCode'])->name('verify-code.verify');
// });
// // Remova ou altere esta linha:
// Route::get('/verify-two-factor', [RegisterController::class, 'showVerifyForm'])->name('verify.two.factor');

// Certifique-se de que a rota está correta para o TwoFactorController
Route::middleware('auth')->group(function () {
    // Ativar dois fatores
    Route::post('/enable-2fa', [TwoFactorController::class, 'enable'])->name('enable-2fa');
    
    // Exibir formulário de verificação de dois fatores
    Route::get('/verify-code', [TwoFactorController::class, 'showForm'])->name('verify-code.form');
    
    // Verificar o código de dois fatores
    Route::post('/verify-code', [TwoFactorController::class, 'verifyCode'])->name('verify-code.verify');
});

// Rota para exibir o formulário de verificação do código
Route::get('/verify-two-factor', [VerificationController::class, 'showForm'])->name('verify.two.factor');

// Rota para processar a verificação do código
Route::post('/verify-two-factor', [VerificationController::class, 'verifyCode'])->name('verify.code');

// Rota para exibir o formulário de verificação após o registro
Route::get('/verify-two-factor', [RegisterController::class, 'showVerifyForm'])->name('verify.two.factor');

// Rota para processar a verificação do código de dois fatores no registro
Route::post('/verify-two-factor', [RegisterController::class, 'verifyTwoFactor']);

// Rota de login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest', 'throttle:5,1');

// Rota para habilitar o 2FA
Route::post('/enable-2fa', [TwoFactorController::class, 'enable']);

// Rota para verificar o código do 2FA
Route::post('/verify-2fa', [TwoFactorAuthController::class, 'verify']);

// Rota para gerar códigos de recuperação
Route::post('/generate-recovery-codes', function () {
    auth()->user()->generateRecoveryCodes();

    return response()->json(['message' => 'Códigos de recuperação gerados com sucesso']);
});

// Rota para exibir o formulário de verificação do código 2FA
Route::get('verify-code', [TwoFactorController::class, 'showForm'])->name('verify.code');

// Rota para processar a verificação do código 2FA
Route::post('verify-code', [TwoFactorController::class, 'verifyCode']);

// Rota para o painel de controle do usuário
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rota para logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redireciona para a página inicial após o logout
})->name('logout');

// Rota para relatórios
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Rota para acesso anônimo
Route::get('/anonymous', [AnonymousController::class, 'index'])->name('anonymous.index');

// Rota para visualizar os usuários
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Rota para atualizar um usuário
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Rota para excluir um usuário
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Rota para upload
Route::get('/upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('/api/uploads', [UploadController::class, 'fetchUploads'])->name('fetchUploads');
Route::post('/upload', [UploadController::class, 'upload'])->name('upload.upload');
Route::get('/upload', function() {
    return view('upload');  // Página de upload
});
Route::get('/upload', [UploadController::class, 'show']);

Route::get('/upload', [UploadController::class, 'index'])->name('upload.index');

Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

// Roteamento para autenticação
require __DIR__.'/auth.php';

// Rotas padrão do Laravel para autenticação
Auth::routes();

// Rota para a página inicial após login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
