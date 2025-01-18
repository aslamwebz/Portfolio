<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiConversation extends Model
{
    protected $fillable = ['title', 'messages'];
    protected $casts = [
        'messages' => 'array'
    ];
}
