<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Livraison;
use App\Models\Paiement;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient',
        'montant',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient', 'patient');
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'vente_articles', 'vente', 'article')
            ->withPivot('quantite')
            ->withTimestamps();
    }
    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'vente');
    }
    public function livraison()
    {
        return $this->hasOne(Livraison::class, 'vente');
    }
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'vente', 'id');
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'vente', 'id');
    }

}