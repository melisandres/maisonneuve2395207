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

        //return a view of the new etudiant;
        return redirect(route('etudiants.show', $newEtudiant->id))->withSuccess('Etudiant enregistré!');

        //or return to the login page? 

        // return redirect()->back()->withSuccess('User enregistré');
        //return redirect(route('login'))->withSuccess('User enregistré');
    }

    public function authentication(Request $request){
        $request->validate([
        /* or is it exists:users.email */
        'email' => 'required|email|exists:users',
        'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)):
            return redirect(route('login'))->withErrors(trans('auth.password'))->withInput();
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function dashboard(){

        $name = 'Guest';
        if(Auth::check()){
        $name = Auth::user()->name;
        }
        return view('forum.dashboard', ['name' =>$name]);
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
        if (Auth::check() && $user->id === Auth::id()) {
            //test if this works  
        }
        $villes = Ville::all();
        $etudiant = $user->hasEtudiant;
        return view('Auth.edit', compact('etudiant', 'villes', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data for the update
        $request->validate([
            'name' => 'required|min:2|max:50',
            'adresse' => 'required|min:2|max:255',
            'phone' => 'required|min:10|max:20',
            'email' => "email|required|unique:users,email,$user->id",
            'dob' => 'required|date|date_format:Y-m-d|before:today',
            'ville_id' => 'required|exists:villes,id',
        ]);

        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update the associated etudiant data
        $user->hasEtudiant->update([
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'ville_id' => $request->ville_id,
        ]);

        // Redirect to a view or route of your choice
        return redirect(route('etudiants.show', $user->hasEtudiant->id))->withSuccess('Etudiant mis à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Auth::check() && $user->id === Auth::id()) {

            // Delete the associated student
            $user->hasEtudiant()->delete();

            // Delete the user
            $user->delete();

            //you have to log them out!
            Auth::logout();
            return redirect(route('dashboard'))->withSuccess('You have successfully been deleted from our databases!');
        }else{
            return redirect()->back()->withErrors('Cannot delete another student');
        }

    }
}
