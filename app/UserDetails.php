<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{

    protected $fillable = [
        'matricule', 'date_embauche', 'situation', 'nbr_enfants', ''
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function userFonctions()
    {
        return $this->hasMany(UserFonction::class);
    }
}
