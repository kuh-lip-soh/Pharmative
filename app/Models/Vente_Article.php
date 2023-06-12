<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente_Article extends Model
{
    use HasFactory;
    protected $table = 'vente_articles';
    protected $primaryKey = 'id';
    protected $foreignKey = 'vente';
    protected $fillable = [
        'vente',
        'article',
        'quantite',
    ];
}