<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    // use HasApiTokens;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name', 'email', 'password', 'brand', 'phone', 'is_active', 'theme', 'is_paid', 'url',
        'color', 'currency', 'is_order', 'discount', 'minorder', 'real_paid', 'order_type',
        'type', 'must_verify', 'is_open', 'remain_lang', 'remain_lang_sub', 'default_lang',
        'product_discount', 'is_franchise', 'franchise_id', 'wapp', 'nonrest',
    ];

    /**
     * Hidden attributes for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_paid' => 'boolean',
        'must_verify' => 'boolean',
        'is_open' => 'boolean',
        'is_order' => 'boolean',
        'is_franchise' => 'boolean',
        'real_paid' => 'boolean',
    ];
}
