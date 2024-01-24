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
        //this is your login page
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

        // Log in the user
        Auth::login($user);

        //return a view of the new etudiant;
        return redirect(route('etudiants.show', $newEtudiant->user_id))->withSuccess(trans('lang.text_student_saved'));
    }

    public function authentication(Request $request){
        //validate the login
        $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        //send errors if there isn't a match
        if(!Auth::validate($credentials)):
            return redirect(route('login'))->withErrors(trans('auth.password'))->withInput();
        endif;

        //get the user info
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        //so you can log them in
        Auth::login($user);

        //TODO: you will not have a dashboard, so you need to clean this up
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
        //the user has to be logged in to access this
        if (Auth::check()) {
            //and a user can not modify another user's information
            if($user->id === Auth::id()){
                $villes = Ville::all();
                $etudiant = $user->hasEtudiant;
                return view('Auth.edit', compact('etudiant', 'villes', 'user'));
            }else{
                return redirect()->back()->withErrors(trans('lang.text_denied'));
            }
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //make user the user is logged in, and it is the right user
        if (Auth::check()) {
            if($user->id === Auth::id()){
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
                return redirect(route('etudiants.show', $user->id))->withSuccess(trans('lang.text_student_edited'));
            }else{
                return redirect()->back()->withErrors(trans('lang.text_denied'));
            }
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //make sure the user is logged in and is the user concerned
        if (Auth::check()) {
            if ($user->id === Auth::id()){
                // Delete the associated student
                $user->hasEtudiant()->delete();

                // Delete the user
                $user->delete();

                //you have to log them out!
                Auth::logout();
                return redirect(route('dashboard'))->withSuccess(trans('lang.text_student_deleted'));
            }else{
                return redirect()->back()->withErrors(trans('lang.text_denied'));
            }
        }else{
            return redirect(route('login'))->withErrors(trans('lang.text_access_denied'));
        }

    }
}
