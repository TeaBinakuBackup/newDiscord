<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserTypeModel extends Model
{
    protected $table = 'user_type';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
}
