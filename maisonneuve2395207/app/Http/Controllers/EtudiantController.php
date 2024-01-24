<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $etudiants = Etudiant::join('users', 'users.id', '=', 'etudiants.user_id')
            ->orderBy('users.name')
            ->paginate(20);

            return view('etudiants.index', compact('etudiants'));
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //we will create etudiants from the 
        //CustomAuthController--as we create users
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //a new student is stored via the 
        //CustomAuthController--as we create users
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        if(Auth::check()){
            $user = User::findOrFail($user_id);
            $etudiant = $user->hasEtudiant;
            return view('etudiants.show', compact('etudiant', 'user'));
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //a new student is stored via the 
        //CustomAuthController--as we create users
    }

    /**
     * For now, the students are updated in the CustomAuthController
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //
    }

}
