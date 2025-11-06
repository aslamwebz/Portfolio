<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiConversation extends Model
{
    protected $fillable = ['title', 'messages'];

    protected $casts = [
        'messages' => 'array',
    ];
}
