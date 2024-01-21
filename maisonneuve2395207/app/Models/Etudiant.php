<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'adresse', 'phone', 'dob', 'ville_id', 'user_id'];

    public function etudiantHasVille() {
        return $this->hasOne('App\Models\Ville', 'id', 'ville_id');
    }

    // Get the user that owns the etudiant
/*     public function hasUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    } */

    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //many articles can be written by one etudiant
    public function hasArticles()
    {
        return $this->hasMany('App\Models\Article', 'user_id', 'id');
    }
}
