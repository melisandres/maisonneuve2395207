<?php

namespace App\Http\Controllers;

use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $uploads = Uploads::with('hasUser')->get();
            //add an order to these?
            return view('uploads.index', compact('uploads'));
        }else{
            return redirect(route('login'))->withErrors('Vous n\'
            êtes pas autorisé à accéder aux documents');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,zip,doc,jpg,jpeg',
        ]);

        //retrieve file, and concatenate the date and the original filename
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Save file to storage/app/uploads
        //Storage::putFileAs('uploads', $file, $fileName);

        // Save file to storage/app/public/uploads
        /* Storage::disk('uploads')->putFileAs('uploads', $file, $fileName); */

          // Save file to storage/app/public/uploads
        Storage::disk('uploads')->putFileAs('', $file, $fileName);


        //get the user id from user logged in
        $user = Auth::user();
        $userID = $user->id;

        //add the uploaded file info to the db
        Uploads::create([
            'title' => $request->title,
            'title_fr' => $request->title_fr,
            'user_id' => $userID,
            'file_path' => $fileName
        ]);

        return redirect()->back()->withSuccess('File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uploads $uploads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uploads $uploads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uploads $uploads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uploads $uploads)
    {
        //
    }

    public function download($filename)
    {
        $filePath = Storage::disk('uploads')->path($filename);

        return response()->download($filePath);
    }
}
