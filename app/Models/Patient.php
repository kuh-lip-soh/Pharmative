<?php

namespace App\Models;

use App\Models\Vente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'date_de_naissance',
        'poids',
        'taille',
        'adresse',
        'telephone',
    ];
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'patient', 'id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
    public function articlesPanier()
    {
        return $this->belongsToMany(Article::class, 'panier_articles', 'panier_id', 'article_id');
    }


}