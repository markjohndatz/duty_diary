<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DocumentationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $docs = Documentation::latest()->get();
        return view('admin.documentations.index')->with('docs',$docs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'doc_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required',
        ]);

        // Check if the request has a file
        if ($request->hasFile('doc_img')) {
            $imageFile = $request->file('doc_img');

            // Generate a unique filename
            $filename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME) . "-" . time() . '.' . $imageFile->getClientOriginalExtension();

            // Store the file
            $path = $imageFile->storeAs('public/images', $filename);

            // Get the authenticated user's ID
            $userId = Auth::id();

            // Create a new entry in the database
            Documentation::create([
                'image' => $filename,
                'caption' => $request->caption,
                'author_id' => $userId,
            ]);

            // Redirect back with a success message
            return redirect()->back()->with('uploadSuccess', 'The image ' . $filename . ' was successfully uploaded!');
        }

        // Handle if no file was uploaded (you can customize this part as needed)
        return redirect()->back()->with('uploadError', 'No file was uploaded.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
