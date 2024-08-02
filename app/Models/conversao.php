<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversao extends Model
{
    use HasFactory;

    protected $fillable = ['numero_real', 'numero_romano'];
}
