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
        //is the user logged in?
        if(Auth::check()){
            //TODO: consider using 'hasUser' here, since its the same
            //code. Just test it. to make sure.
            $articles = Article::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            //send the french title and text if the user has selected french
            $locale = app()->getLocale();
            if ($locale == 'fr'){
                foreach($articles as $article){
                    if($article->title_fr != ""){
                        $article->title = $article->title_fr;
                    }
                    if($article->text_fr != ""){
                        $article->text = $article->text_fr;
                    }
                }
            }
            return view('articles.index', compact('articles'));
        }else{
            //return to login, with error if the user is not logged in
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //check if the user is logged in
        if(Auth::check()){
            return view('articles.create');
        }else{
            //return to login, with error if the user is not logged in
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //check if the user is logged in
        if(Auth::check()){
            //validation
            $request->validate([
                'title' => 'required|min:2|max:190',
                'title_fr' => 'max:190',
                'text' => 'required|min:10|max:65500',
                'text_fr' => 'max:65500'
            ]);

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

            //Save the new article
            $newArticle->save();

            //return a view of the new article;
            return redirect(route('articles.show', $newArticle->id))->withSuccess(trans('lang.text_article_saved'));
        }else{
            //send the user to the login
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        if(Auth::check()){
            $user = $article->hasUser;

            //translate if locale == fr
            $locale = app()->getLocale();
            if ($locale == 'fr'){
                if($article->title_fr != ""){
                    $article->title = $article->title_fr;
                }
                if($article->text_fr != ""){
                    $article->text = $article->text_fr;
                }
            }

            
            return view('articles.show', compact('article', 'user'));
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
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
                return redirect()->route('articles.index')->withErrors(trans('lang.text_denied'));
            }
        } else {
            // User is not authenticated
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
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

            return redirect(route('articles.show', $article->id))->withSuccess(trans('lang.text_article_edit'));
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));;
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
                return redirect(route('articles.index'))->withSuccess(trans('lang.text_article_delete'));;
            }else{
                return redirect(route('articles.index'))->withErrors(trans('lang.text_denied'));;
            }
        }
        else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));;
        }
    }
}
