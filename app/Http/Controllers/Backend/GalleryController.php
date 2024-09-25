<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::where('name','first')->first();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.content.gallery',compact('gallery'));
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
    public function store(Request $request , $id)
    {

        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->toWebp(60);
            $path = 'admins/gallery/';
            $name = uniqid();
            $full_Path = $path . $name . '.' . 'webp';
            $image->save(public_path($full_Path));

            $file = new File();
            $file->fileable_id = $id;
            $file->fileable_type = Gallery::class;
            $file->file = $full_Path;
            $file->extension = 'webp';
            $file->save();

            return response()->json(['message'=>'Uploaded Successfully'],'200');

        }

        return response()->json(['message'=>'something went Wrong'],'500');


    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = File::where('id',$id)->first();
        $imagePath = public_path($image->file);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();
        $notification = createNotification('success','DeletedSuccessfully');
        return redirect()->route('gallery.index')->with($notification);

    }
}
