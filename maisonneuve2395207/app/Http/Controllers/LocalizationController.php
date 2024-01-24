<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index($locale){

        // Flash old input to the session
        //session()->flashInput(request()->input());

        session()->put('locale', $locale);
        return redirect()->back();
    }
}
