<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use App\Models\Etudiant;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    //make sure the user currently logged in has same id as
    //the author of the article, befor showing the edit button
    //in the view
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    //same for buttons to edit student information
    public function updateEtudiant(User $user, Etudiant $etudiant)
    {
        return $user->id === $etudiant->user_id;
    }

}
