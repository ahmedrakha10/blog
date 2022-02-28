<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $appends = ['image_path'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return Storage::url('uploads/' . $this->image);
        }

        return asset('admin_assets/images/default.png');

    }
}
