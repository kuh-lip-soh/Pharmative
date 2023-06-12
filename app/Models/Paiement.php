<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient',
        'montant',
        'code',
        'type',
    ];
    protected $casts = [
        'code' => 'encrypted',
    ];
    public function vente()
    {
        return $this->belongsTo(Vente::class, 'vente', 'id');
    }

}