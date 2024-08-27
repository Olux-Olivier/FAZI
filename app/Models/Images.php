<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
        'bien_id'
    ];



    public function biens()
    {
        return $this->belongsTo(Bien::class);
    }
}
