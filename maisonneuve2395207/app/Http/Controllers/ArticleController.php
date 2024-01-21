<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            //TODO: consider using 'hasUser' here, since its the same
            //code. Just test it. to make sure.
            $articles = Article::with('user')->paginate(1);
            //add an order to these?
            return view('articles.index', compact('articles'));
        }else{
            return redirect(route('login'))->withErrors('Vous n\'
            êtes pas autorisé à accéder aux articles');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check()){
            return view('articles.create');
        }else{
            return redirect(route('login'))->withErrors('Vous n\'
            êtes pas autorisé à accéder au create articles');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            //NEXT STEP ADD VALIDATION TO YOUR VIEW
            $request->validate([
                'title' => 'required|min:2|max:190',
                'title_fr' => 'max:190',
                'text' => 'required|min:10|max:65500',
                'text_fr' => 'max:65500'
            ]);
            /* dd($request); */

            //get the user id from user logged in
            $user = Auth::user();
            $userID = $user->id;

            //Gather article data from the request data
            $newArticle = new Article([
                'title' => $request->title,
                'title_fr' => $request->title_fr,
                'text' => $request->text,
                'text_fr' => $request->text_fr,
                'user_id' => $userID
            ]);

            // Save the new article
            $newArticle->save();

            //return a view of the new article;
            return redirect(route('articles.show', $newArticle->id))->withSuccess('Article saved!');
        }else{
            //send the user to the login
            return redirect(route('login'))->withErrors('Vous n\'
            êtes pas autorisé à accéder');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        if(Auth::check()){
            $user = $article->hasUser;
            //try find by id etudian, city id... to fix the webdev issue...
            return view('articles.show', compact('article', 'user'));
        }else{
            return redirect(route('login'))->withErrors('Vous n\'
            êtes pas autorisé à accéder a un article');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if(Auth::check()){
            // Get the authenticated user's ID
            $authenticatedUserId = Auth::user()->id;

            // Check if the authenticated user's ID matches the article's user_id
            if ($authenticatedUserId == $article->user_id) {
                $user = $article->hasUser;
                //try find by id etudian, city id... to fix the webdev issue...
                return view('articles.edit', compact('article', 'user'));

            } else {
                // Authenticated user does not have access to the article
                return redirect()->route('articles.index')->withErrors('Vous n\'êtes pas autorisé à modifier cet article.');
            }
        } else {
            // User is not authenticated
            return redirect(route('login'))->withErrors('Vous n\'êtes pas autorisé à accéder.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if(Auth::check()){
            $request->validate([
                'title' => 'required|min:2|max:190',
                'title_fr' => 'max:190',
                'text' => 'required|min:10|max:65500',
                'text_fr' => 'max:65500'
            ]);

            $article->update([
                'title' => $request->title,
                'title_fr' => $request->title_fr,
                'text' => $request->text,
                'text_fr' => $request->text_fr
            ]);

            return redirect(route('articles.show', $article->id))->withSuccess('Article mis a jour!');
        }else{
            return redirect(route('login'))->withErrors('Vous devez être connectées pour faire cela!');;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if(Auth::check()){
            // Get the authenticated user's ID
            $authenticatedUserId = Auth::user()->id;

            // Check if the authenticated user's ID matches the article's user_id
            if ($authenticatedUserId == $article->user_id) {
                $article->delete();
                return redirect(route('articles.index'))->withSuccess('Article effacé!');;
            }else{
                return redirect(route('articles.index'))->withErrors('Vous navez pas ce privilege!');;
            }
        }
        else{
            return redirect(route('login'))->withErrors('Vous navez pas ce privilege!');;
        }
    }
}
