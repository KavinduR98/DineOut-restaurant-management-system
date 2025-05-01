<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Concession extends Model
{
    use HasFactory;
    protected $table = 'concessions';
    protected $fillable = ['name', 'image_path', 'description', 'price'];
}
