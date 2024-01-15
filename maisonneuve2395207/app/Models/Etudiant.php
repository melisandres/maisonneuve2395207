<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'adresse', 'phone', 'dob', 'ville_id'];

    public function etudiantHasVille() {
        return $this->hasOne('App\Models\Ville', 'id', 'ville_id');
    }

    // Get the user that owns the etudiant
    public function hasUser()
    {
        /* return $this->belongsTo(User::class); */
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
