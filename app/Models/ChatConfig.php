<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatConfig extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['agency_id',
        'client_id',
        'role',
        'content',
   ];
}
