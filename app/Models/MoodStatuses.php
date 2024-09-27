<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MoodStatuses extends Model
{
    protected $table = 'mood_statuses';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'mood_status_id');
    }
}
