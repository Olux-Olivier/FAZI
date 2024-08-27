<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    public $fillable = [
        'chambre',
        'type_bien',
        'commune',
        'quartier',
        'avenue',
        'numero',
        'description',
        'loyer',
        'garantie',
        'prix_vente',
        'surface',
        'user_id'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
