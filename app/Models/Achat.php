<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Achat extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'fournisseur',
    ];
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'achat_articles', 'achat', 'article')
            ->withPivot('quantite')
            ->withTimestamps();
    }


}