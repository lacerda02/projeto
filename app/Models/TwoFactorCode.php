<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactorCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'expires_at',
    ];

    /**
     * Define a relação com o modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
