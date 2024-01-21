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
            'title' => 'required|min:2|max:255',
            'title_fr' => ' min:2|max:255',
        ]);

        //retrieve file, and concatenate the date and the original filename
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();


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

        return redirect()->route('uploads.index')->withSuccess('File uploaded successfully.');
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
    public function edit(Uploads $upload)
    {
        if(Auth::check()){
            // Get the authenticated user's ID
            $authenticatedUserId = Auth::user()->id;

            // Check if the authenticated user's ID matches the upload's user_id
            if ($authenticatedUserId == $upload->user_id) {
                $user = $upload->hasUser;
                //try find by id etudian, city id... to fix the webdev issue...
                return view('uploads.edit', compact('upload', 'user'));

            } else {
                // Authenticated user does not have access to the upload
                return redirect()->route('uploads.index')->withErrors('Vous n\'êtes pas autorisé à modifier ce document.');
            }
        } else {
            // User is not authenticated
            return redirect(route('login'))->withErrors('Vous n\'êtes pas autorisé à accéder a cette fonctionalité.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uploads $upload)
    {
        $request->validate([
            'file' => 'file|mimes:pdf,zip,doc,jpg,jpeg',
            'title' => 'required|min:2|max:255',
            'title_fr' => ' min:2|max:255',
        ]);

            // Check if a new file is provided
        if ($request->hasFile('file')) {
            // Delete the previous file
            Storage::disk('uploads')->delete($upload->file_path);

            // Retrieve the new file and concatenate the date and the original filename
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Save the new file to storage/app/public/uploads
            Storage::disk('uploads')->putFileAs('', $file, $fileName);

            // Update the file_path in the database
            $upload->update(['file_path' => $fileName]);

            //retrieve file, and concatenate the date and the original filename
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
        }

        
        // Update other fields in the database
        $upload->update([
            'title' => $request->title,
            'title_fr' => $request->title_fr,
        ]);

        return redirect()->route('uploads.index')->withSuccess('File updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uploads $uploads)
    {

       // Get the file path before deleting the record
        $filePath = $uploads->file_path;

        // Delete the record from the database
        $uploads->delete();

        // Delete the file from storage
        Storage::disk('uploads')->delete($filePath);

        return redirect(route('uploads.index'))->withSuccess('File deleted!');
    }

    public function download($filename)
    {
        $filePath = Storage::disk('uploads')->path($filename);

        return response()->download($filePath);
    }
}
