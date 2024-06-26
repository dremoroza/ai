<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $hidden = ['id'];

    protected $fillable = ['uid',
     'agency_name',
    ];
    
}
