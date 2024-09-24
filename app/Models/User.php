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
        'email',
        'password',
        'tel',
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
        'password' => 'hashed',
    ];

    //postとのリレーション
    public function posts() 
    {
        return $this->hasMany(Post::class);
    }

    //ブックマークとのリレーション
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, Post::class);
    }

    //いいねとのリレーション
    public function likes()
    {
        return $this->hasMany(Like::class, Post::class);
    }

    //BMコインとのリレーション
    public function coins()
    {
        return $this->hasMany(Coin::class);
    }

    //Amazonとのリレーション
    public function amazons(){

        return $this->hasMany(Amazon::class);
    }

    //Reportとのリレーション
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    //Contactとのリレーション
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }
}
