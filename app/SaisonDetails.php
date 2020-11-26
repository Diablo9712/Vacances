<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaisonDetails extends Model
{

    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }


    public function saisons()
    {
        return $this->hasMany(Saison::class);
    }
}
