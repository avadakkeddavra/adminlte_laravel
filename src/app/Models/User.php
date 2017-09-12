<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Products as ProductsModel;
class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;


    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','deleted_at',
    ];


    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function isAdmin()
    {
        return (int) $this->role_id === User::ROLE_ADMIN;
    }

    public function products()
    {
        return $this->hasMany(ProductsModel::class,'user_id','id');
    }
}
