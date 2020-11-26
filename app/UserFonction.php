<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFonction extends Model
{
    protected $fillable = ['label'];

    public function userDetails()
    {
        return $this->belongsTo(UserDetails::class);
    }
}
