<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    public function centres()
    {
        return $this->hasMany(Centre::class);
    }


    public function priorites()
    {
        return $this->hasMany(Priorite::class);
    }
}
