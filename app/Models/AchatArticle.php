<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchatArticle extends Model
{
    use HasFactory;
    protected $fillable = [
        'achat',
        'article',
        'quantite',
    ];
}