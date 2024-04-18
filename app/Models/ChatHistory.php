<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['chat_id',
        'role',
        'content',
   ];
}
