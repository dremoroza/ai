<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $hidden = ['id'];

    protected $fillable = ['agency_id',
     'uid',
     'client_id',
    ];
    
}
