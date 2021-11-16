<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function monies()
    {
        return $this->hasMany(Money::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function sub_contracts()
    {
        return $this->hasMany(SubContract::class);
    }

    public function labors()
    {
        return $this->hasMany(Labor::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}