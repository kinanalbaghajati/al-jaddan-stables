<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\File;
use Illuminate\Http\Request;
use Intervention\Image;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;

class ContentController extends Controller
{
    public function index()
    {
        $first_section = Content::where('name', 'first')->first();
        $trans_text = $first_section->getTranslations('text');
        return view('backend.content.first_section', compact('trans_text', 'first_section'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|numeric',
                'editor_en' => 'string',
                'editor_ar' => 'string'
            ]);


            $obj = Content::where('id', $request->id)->first();
            $trans_text = $obj->getTranslations('text');
            if ($request->filled('editor_en')) {
                $translations = ['en' => $request->editor_en, 'ar' => $trans_text['ar'] ?? 'Text Not Available'];
                $obj->update([
                    'text' => $translations,
                ]);
            }

            if ($request->filled('editor_ar')) {
                $translations = ['en' => $trans_text['en'] ?? 'Text Not Available', 'ar' => $request->editor_ar];
                $obj->update([
                    'text' => $translations,
                ]);
            }

            $notification = createNotification('success', 'Inserted Successfully');
            return back()->with($notification);
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return redirect()->route('first.content.index')->with($notification);
        }
    }

    public function updateImage(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);


            $obj = Content::where('id', $request->id)->first();

            if ($obj && $obj->file) {
                $imagePath = public_path($obj->file->file);
                unlink($imagePath);
                $obj->file->delete();
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->image)->toWebp(60);
            $path = 'admins/home/';
            $name = time();
            $full_Path = $path . $name . '.' . 'webp';
            $image->save(public_path($full_Path));


            $file = new File();
            $file->fileable_id = $obj->id;
            $file->fileable_type = Content::class;
            $file->file = $full_Path;
            $file->extension = 'webp';
            $file->save();

            $notification = createNotification('success', 'Image Inserted Successfully');
            return back()->with($notification);
        } catch (\Throwable $throwable) {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->route('first.content.index')->with($notification);
        }
    }

    public function indexSecond()
    {
        $second_section = Content::where('name', 'second')->first();
        $trans_text = $second_section->getTranslations('text');
        return view('backend.content.second_section', compact('trans_text', 'second_section'));
    }

    public function updateSecond(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|numeric',
                'editor_en' => 'string|max:450',
                'editor_ar' => 'string|max:450'
            ]);


            $obj = Content::where('id', $request->id)->first();
            $trans_text = $obj->getTranslations('text');
            if ($request->filled('editor_en')) {
                $translations = ['en' => $request->editor_en, 'ar' => $trans_text['ar'] ?? 'Text Not Available'];
                $obj->update([
                    'text' => $translations,
                ]);
            }

            if ($request->filled('editor_ar')) {
                $translations = ['en' => $trans_text['en'] ?? 'Text Not Available', 'ar' => $request->editor_ar];
                $obj->update([
                    'text' => $translations,
                ]);
            }

            $notification = createNotification('success', 'Inserted Successfully');
            return back()->with($notification);
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return redirect()->route('second.content.index')->with($notification);
        }
    }

    public function updateImageSecond(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);


            $obj = Content::where('id', $request->id)->first();

            if ($obj && $obj->file) {
                $imagePath = public_path($obj->file->file);
                unlink($imagePath);
                $obj->file->delete();
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->image)->toWebp(60);
            $path = 'admins/home/';
            $name = time();
            $full_Path = $path . $name . '.' . 'webp';
            $image->save(public_path($full_Path));


            $file = new File();
            $file->fileable_id = $obj->id;
            $file->fileable_type = Content::class;
            $file->file = $full_Path;
            $file->extension = 'webp';
            $file->save();

            $notification = createNotification('success', 'Image Inserted Successfully');
            return back()->with($notification);
        } catch (\Throwable $throwable) {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->route('second.content.index')->with($notification);
        }
    }

   public function mainTitleIndex()
   {
       $title = Content::where('name','title')->first();
       $trans_title = $title->getTranslations('text');
       return view('backend.content.main_title',compact('trans_title','title'));
   }

   public function mainTitleUpdate(Request $request)
   {
       try {
           $request->validate([
               'id' => 'required|numeric',
               'editor_en' => 'string',
               'editor_ar' => 'string'
           ]);


           $obj = Content::where('id', $request->id)->first();
           $trans_text = $obj->getTranslations('text');
           if ($request->filled('editor_en')) {
               $translations = ['en' => $request->editor_en, 'ar' => $trans_text['ar'] ?? 'Text Not Available'];
               $obj->update([
                   'text' => $translations,
               ]);
           }

           if ($request->filled('editor_ar')) {
               $translations = ['en' => $trans_text['en'] ?? 'Text Not Available', 'ar' => $request->editor_ar];
               $obj->update([
                   'text' => $translations,
               ]);
           }

           $notification = createNotification('success', 'Inserted Successfully');
           return back()->with($notification);
       } catch (\Throwable $th) {
           $notification = createNotification('error', $th->getMessage());
           return back()->with($notification);
       }
   }
}
