<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'title_fr', 'text', 'text_fr', 'user_id'];

    //an article belongs to one student
    public function hasEtudiant()
    {
        return $this->belongsTo('App\Models\Etudiant', 'user_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
