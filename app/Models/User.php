<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use PragmaRX\Google2FAQRCode\Google2FA;
use OwenIt\Auditing\Contracts\Auditable; // Interface necessária para auditoria
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait necessária para auditoria

class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable, AuditableTrait;

    /**
     * Campos que devem ser auditados.
     *
     * @var array<string>
     */
    protected $auditInclude = [
        'name',
        'email',
        'is_active',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * Campos que devem ser excluídos da auditoria.
     *
     * @var array<string>
     */
    protected $auditExclude = [
        'password', // Ocultar mudanças de senha nas auditorias
        'remember_token',
        'two_factor_secret',
    ];

    /**
     * Atributos atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_code',
        'two_factor_expires_at',
        'is_active',
    ];

    /**
     * Atributos ocultos na serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Gera códigos de recuperação de dois fatores.
     *
     * @return void
     */
    public function generateRecoveryCodes()
    {
        $recoveryCodes = json_encode(collect(range(1, 8))->map(function () {
            return Str::random(10);
        })->toArray());

        $this->two_factor_recovery_codes = $recoveryCodes;
        $this->save();
    }

    /**
     * Limpa o código de dois fatores.
     *
     * @return void
     */
    public function clearTwoFactorCode()
    {
        $this->update([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ]);
    }

    /**
     * Obtém usuários com cache.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUsersWithCache()
    {
        return Cache::remember('users_list', 60, function () {
            return User::all();
        });
    }

    /**
     * Gera uma nova chave secreta para autenticação de dois fatores.
     *
     * @return void
     */
    public function generateTwoFactorSecret()
    {
        $google2fa = new Google2FA();
        $this->two_factor_secret = $google2fa->generateSecretKey();
        $this->save();
    }

    /**
     * Carrega usuários com seus posts usando Eager Loading.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUsersWithPosts()
    {
        return User::with('posts')->get();
    }

    /**
     * Carrega um usuário e seus posts usando Lazy Loading.
     *
     * @param int $id
     * @return \App\Models\User|null
     */
    public static function getUserWithPosts($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->load('posts'); // Lazy loading
        }
        return $user;
    }
}
