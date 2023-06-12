<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vente;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'code',
        'date_de_peremption',
        'stock',
        'stock_min',
        'description',
        'prix',
        'utilisation',
    ];
    public function ventes()
    {
        return $this->belongsToMany(Vente::class, 'vente_articles', 'article', 'vente')
            ->withPivot('quantite');
    }


}