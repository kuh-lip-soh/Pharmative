<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = [
        'vente',
        'etat',
    ];
    public function vente()
    {
        return $this->belongsTo(Vente::class, 'vente', 'id');
    }
}