<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'montant',
        'user_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
