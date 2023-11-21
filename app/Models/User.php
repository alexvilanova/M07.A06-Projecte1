<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
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
        'role_id',
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
    
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->roles->contains('name', $role)) {
                    return true;
                }
            }
        } else {
            if ($this->roles->contains('name', $roles)) {
                return true;
            }
        }
        return false;
    }

    public function canAccessFilament(): bool
    {
        return in_array($this->role_id, ['2', '3']); // Devuelve true si eres editor o admin
    }
 
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    
    public function places()
    {
       return $this->hasMany(Place::class, 'author_id');
    }
    public function favorites()
    {
        return $this->belongsToMany(Place::class, 'favorites');
    }

    
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }	
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
 
}
