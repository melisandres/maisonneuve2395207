<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ville;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = Ville::all();
        return view('auth.create', compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'adresse' => 'required|min:2|max:255',
            'phone' => 'required|min:10|max:20',
            'email' => 'email|required|unique:users',
            'dob' => 'required|date|date_format:Y-m-d|before:today',
            'ville_id' => 'required|exists:villes,id',
            'password' => ['required', Password::min(2)->letters()->numbers()->mixedCase(), 'max:20'],
            /* 'password' => 'required|min:2|max:20|mixedCase|letters|numbers', */
            'confirmation-password' => 'required|same:password'
        ]);

        // Create a new user with the request data
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        // Gather etudiant data from the request data
        $newEtudiant = new Etudiant([
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'ville_id' => $request->ville_id,
        ]);

        // Create a new etudiant and associate it with the user
        $user->hasEtudiant()->save($newEtudiant);

        //return $newEtudiant;
        return redirect(route('etudiants.show', $newEtudiant->id))->withSuccess('Etudiant enregistré!');

        // return redirect()->back()->withSuccess('User enregistré');
        //return redirect(route('login'))->withSuccess('User enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
