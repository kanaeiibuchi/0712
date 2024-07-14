<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
        protected $fillable = ['chat','user_id','team_id'];
        
    public function user()
        {
            return $this->belongsTo(User::class);
        }
    public function team()
        {
            return $this->belongsTo(Team::class);
        }
}
