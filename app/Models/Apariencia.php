<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apariencia extends Model
{
    
        protected $table = 'apariencia';
        protected $fillable = ['logo', 'is_logo_active'];
    

}