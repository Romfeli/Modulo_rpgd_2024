<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalText extends Model
{
    use HasFactory;


    protected $table = 'legal_texts';

    protected $fillable = [
        'title',
        'content',
    ];
}
