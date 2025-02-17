<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = ['user_id', 'content', 'result'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
