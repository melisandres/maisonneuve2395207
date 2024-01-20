<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_fr', 'user_id', 'file_path'];

    public function hasUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
