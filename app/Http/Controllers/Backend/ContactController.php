<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'url' => 'required|url',
            'image' => 'required|file|mimes:svg,png'
        ]);



        $ext = $request->image->getClientOriginalExtension();
        $path = 'admins/contact/';
        $name = time();
        $full_name = $path . $name . '.' . $ext;
        $full = public_path($path);
        $request->image->move($full , $full_name);

        $contact = new Contact();
        $contact->name = $request->url;
        $contact->type = $full_name;
        $contact->save();

        $notification = createNotification('success', 'inserted Successfully');
        return back()->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $Contact = Contact::where('id', $id)->first();
            $image_file = public_path($Contact->type);
            if (file_exists($image_file)) {
                unlink($image_file);
            }
            $Contact->delete();
            $notification = createNotification('success','Deleted Successfully');
            return back()->with($notification);
        }catch (\Throwable $throwable)
        {
            $notification = createNotification('error',$throwable->getMessage());
            return back()->with($notification);
        }
    }
}
