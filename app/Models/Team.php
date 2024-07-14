<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['team', 'user_id','roll_flg'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
