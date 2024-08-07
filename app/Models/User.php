<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'telephone',
        'entreprise',
        'adresse',
        'telephoneE',
        'UrlFacebook',
        'UrlInstagram',
        'UrlGoogle',
        'UrlSite',
        'abonnement',
        'imageFacebook',
        'imageInstagram',
        'imageGoogle',
        'imageSite',
        'status'
        
    ];

    
    public function indicateur()
    {
        return $this->hasMany(Indicateur::class);
    }
    public function compagne()
    {
        return $this->hasMany(compagne::class);
    }
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
