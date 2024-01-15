<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from blog_posts; 
        $etudiants = Etudiant::orderBy('nom')->paginate(20);
       // return $blog;
       // return view('blog.index', ['blogs'=> $blogs]);
       return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $villes = Ville::all();
        return view('etudiants.create', compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|min:2|max:50',
            'adresse' => 'required|min:2|max:255',
            'phone' => 'required|min:10|max:20',
            'email' => 'email|required|unique:etudiants',
            'dob' => 'required|date|date_format:Y-m-d|before:today',
            'unite' => 'numeric|decimal:2|gt:0',
            'ville_id' => 'required|exists:villes,id',
            'password' => ['required', Password::min(2)->letters()->numbers()->mixedCase(), 'max:20'],
            /* 'password' => 'required|min:2|max:20|mixedCase|letters|numbers', */
            'confirmation-password' => 'required|same:password'
        ]);

        //
        $newEtudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'ville_id' => $request->ville_id,
        ]);

        //return $newBlog;
        return redirect(route('etudiants.show', $newEtudiant->id))->withSuccess('Etudiant enregistré!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //try find by id etudian, city id... to fix the webdev issue...
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
        $villes = Ville::all();
        return view('etudiants.edit', compact('etudiant', 'villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'nom' => 'required|min:2|max:50',
            'adresse' => 'required|min:2|max:255',
            'phone' => 'required|min:10|max:20',
            'email' => 'email|required|unique:etudiants,email,'.$etudiant->id,
            'dob' => 'required|date|before:today',
            'ville_id' => 'required|exists:villes,id',
        ]);
        //
        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'ville_id' => $request->ville_id,
        ]);

        return redirect(route('etudiants.show', $etudiant->id))->withSuccess('Etudiant mis a jour!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
        $etudiant->delete();

        return redirect(route('etudiants.index'))->withSuccess('Etudiant effacé!');
    }

    public function query(){
        //INNER
        //Select * from blog_posts INNER JOIN users on  user_id = users.id;
        $etudiant = Etudiant::select()
                        ->join('villes', 'ville_id','=','villes.id')
                        ->get();

        //OUTER
        //Select * from blog_posts RIGHT OUTER JOIN users on  user_id = users.id;
        $etudiant = Etudiant::select()
                        ->rightJoin('villes', 'ville_id','=','villes.id')
                        ->get();
        
        $etudiant = Etudiant::find(1);

        return $etudiant->etudiantHasVille->nom;

    }
}
