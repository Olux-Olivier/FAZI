<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'typecommande',
        'user_id',
        'id_bien'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
