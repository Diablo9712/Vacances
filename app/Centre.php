<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $fillable = [
        'libelle', 'adresse', 'tel', 'assistant',
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
