<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public function priorite() {
        return $this->belongsTo(Priorite::class, 'id_priorite');
    }

    public function centre()
    {
        return $this->belongsTo(Centre::class, 'id_centre');
    }

    public function centreEtat()
    {
        return $this->belongsTo(Etatcentre::class, 'id_etat_centre');
    }
}
