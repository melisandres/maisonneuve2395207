<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from blog_posts; 
        $etudiants = Etudiant::all();
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
        return view('etudiants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $newEtudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'ville' => $request->ville_id,
        ]);

        //return $newBlog;
        return redirect(route('etudiants.show', $newEtudiant->id))->withSuccess('Etudiant enregistré!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //
        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'ville' => $request->ville_id,
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
