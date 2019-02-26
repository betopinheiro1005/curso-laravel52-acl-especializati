<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        // Relacionamento de muitos para um 
        return $this->belongsTo(User::class);
    }
}