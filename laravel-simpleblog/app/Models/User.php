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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

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
    ];

    public function getImageURL(){
    if($this->image){
        return url('storage/'.$this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
    }

    public function kategori(){
        return $this->hasMany(Kategori::class);
    // kalo hasMany itu one-to-many sedangkan belongsto itu buat one-to-one
    // untuk menggunakan function dimodel, dengan cara compact dicontrollernya atau juga bisa misal {{ $user->getImageURL() }}
    // atau bisa juga {{ $user->kategori }}
    }
}
