<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $hidden = ['id'];

    protected $fillable = ['uid',
     'agency_id',
     'client_name',
    ];
    
}
