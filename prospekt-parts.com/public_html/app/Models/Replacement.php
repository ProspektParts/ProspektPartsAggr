<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replacement extends Model
{
    use HasFactory;
    //Replacement::all()

    protected $table = 'replacement';

    protected $fillable = [ 
        'analog', 'part', 'created_at', 'updated_at'
    ];
}
