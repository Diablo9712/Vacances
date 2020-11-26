<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    public function saisonDetails()
    {
        return $this->hasOne(SaisonDetails::class);
    }
}
