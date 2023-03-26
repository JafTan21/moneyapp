<?php

namespace App\Models;

use App\Traits\HasMyData;
use App\Traits\Searchable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Searchable;
    use HasMyData;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

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

    public static $searchables = [
        'name',
        'email',
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

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function contracted()
    {
        return $this->hasMany(ContractedForm::class);
    }

    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) { // before delete() method call this
            $user->monies()->delete();
            $user->projects()->delete();
            $user->sub_contracts()->delete();
            $user->labors()->delete();
            $user->bills()->delete();
            $user->suppliers()->delete();
            $user->materials()->delete();
            $user->contracted()->delete();
        });
    }
}
