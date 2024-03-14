<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postIg extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','link'];
}
