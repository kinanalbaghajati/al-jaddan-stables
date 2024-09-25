<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Horse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;


class HorseController extends Controller
{

    public function index($type)
    {
        $horses = Horse::where('type', $type)->latest()->get();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.horses.index', compact('horses', 'type'));
    }

    public function create()
    {
        return view('backend.horses.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'owner_en' => 'required|string',
                'owner_ar' => 'required|string',
                'type' => 'required|string',
                'age' => 'required|numeric',
                'disc_en' => 'required|string',
                'disc_ar' => 'required|string',
                'main_image' => 'required|file|mimes:jpg,jpeg,webp,png',
                'cover_image' => 'required|file|mimes:jpg,jpeg,webp,png',
            ]);
            $json_en = [
                'father_side' => [
                    'parent' => '',
                    'grand_stallion' => '',
                    'grand_mare' => '',
                    '2nd_1_grand_stallion' => '',
                    '2nd_1_grand_mare' => '',
                    '2nd_2_grand_stallion' => '',
                    '2nd_2_grand_mare' => '',
                    '3nd_1_grand_stallion' => '',
                    '3nd_1_grand_mare' => '',
                    '3nd_2_grand_stallion' => '',
                    '3nd_2_grand_mare' => '',
                    '3nd_3_grand_stallion' => '',
                    '3nd_3_grand_mare' => '',
                    '3nd_4_grand_stallion' => '',
                    '3nd_4_grand_mare' => '',
                ],
                'mother_side' => [
                    'parent' => '',
                    'grand_stallion' => '',
                    'grand_mare' => '',
                    '2nd_1_grand_stallion' => '',
                    '2nd_1_grand_mare' => '',
                    '2nd_2_grand_stallion' => '',
                    '2nd_2_grand_mare' => '',
                    '3nd_1_grand_stallion' => '',
                    '3nd_1_grand_mare' => '',
                    '3nd_2_grand_stallion' => '',
                    '3nd_2_grand_mare' => '',
                    '3nd_3_grand_stallion' => '',
                    '3nd_3_grand_mare' => '',
                    '3nd_4_grand_stallion' => '',
                    '3nd_4_grand_mare' => '',
                ]
            ];
            $json_ar = [
                'father_side' => [
                    'parent' => '',
                    'grand_stallion' => '',
                    'grand_mare' => '',
                    '2nd_1_grand_stallion' => '',
                    '2nd_1_grand_mare' => '',
                    '2nd_2_grand_stallion' => '',
                    '2nd_2_grand_mare' => '',
                    '3nd_1_grand_stallion' => '',
                    '3nd_1_grand_mare' => '',
                    '3nd_2_grand_stallion' => '',
                    '3nd_2_grand_mare' => '',
                    '3nd_3_grand_stallion' => '',
                    '3nd_3_grand_mare' => '',
                    '3nd_4_grand_stallion' => '',
                    '3nd_4_grand_mare' => '',
                ],
                'mother_side' => [
                    'parent' => '',
                    'grand_stallion' => '',
                    'grand_mare' => '',
                    '2nd_1_grand_stallion' => '',
                    '2nd_1_grand_mare' => '',
                    '2nd_2_grand_stallion' => '',
                    '2nd_2_grand_mare' => '',
                    '3nd_1_grand_stallion' => '',
                    '3nd_1_grand_mare' => '',
                    '3nd_2_grand_stallion' => '',
                    '3nd_2_grand_mare' => '',
                    '3nd_3_grand_stallion' => '',
                    '3nd_3_grand_mare' => '',
                    '3nd_4_grand_stallion' => '',
                    '3nd_4_grand_mare' => '',
                ]
            ];
            $horse = new Horse();
            $translations_name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $horse->name = $translations_name;
            $translations_owner = ['en' => $request->owner_en, 'ar' => $request->owner_ar];
            $horse->owner = $translations_owner;
            $translations_disc = ['en' => $request->disc_en, 'ar' => $request->disc_ar];
            $horse->disc = $translations_disc;
            $horse->ancestors = ['en' => json_encode($json_en) , 'ar' => json_encode($json_ar)];
            $horse->type = $request->type;
            $horse->age = $request->age;
            $horse->save();

            if ($request->has('main_image')) {
                $manager_main = new ImageManager(new Driver());
                $image = $manager_main->read($request->main_image)->toWebp(60);
                $path = 'backend_theme/horse/images/cover-main/';
                $name = uniqid();
                $full_Path = $path . $name . '.' . 'webp';
                $image->save(public_path($full_Path));


                $file_main = new File();
                $file_main->fileable_id = $horse->id;
                $file_main->fileable_type = Horse::class;
                $file_main->file = $full_Path;
                $file_main->extension = 'main';
                $file_main->save();
            }

            if ($request->has('cover_image')) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->cover_image)->toWebp(60);
                $path = 'backend_theme/horse/images/cover-main/';
                $name = uniqid();
                $full_Path = $path . $name . '.' . 'webp';
                $image->save(public_path($full_Path));


                $file = new File();
                $file->fileable_id = $horse->id;
                $file->fileable_type = Horse::class;
                $file->file = $full_Path;
                $file->extension = 'cover';
                $file->save();
            }


            $notification = createNotification('success', 'Created Successfully');
            return redirect()->route('horses.index', $horse->type)->with($notification);
        } catch (\Throwable $throwable) {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    public function ancestors($id)
    {
        $horse = Horse::where('id', $id)->first();
        return view('backend.horses.ancestors', compact('horse'));
    }

    public function storeAncestors(Request $request)
    {
        $request->validate([
            '*' => 'required|string',
            'id' => 'required|numeric'
        ]);

        try {
            $json_en = [
                'father_side' => [
                    'parent' => $request->stallion_en,
                    'grand_stallion' => $request->fs_grand_stallion_en,
                    'grand_mare' => $request->fs_grand_mare_en,
                    '2nd_1_grand_stallion' => $request->fs_2nd_1_grand_stallion_en,
                    '2nd_1_grand_mare' => $request->fs_2nd_1_grand_mare_en,
                    '2nd_2_grand_stallion' => $request->fs_2nd_2_grand_stallion_en,
                    '2nd_2_grand_mare' => $request->fs_2nd_2_grand_mare_en,
                    '3nd_1_grand_stallion' => $request->fs_3nd_1_grand_stallion_en,
                    '3nd_1_grand_mare' => $request->fs_3nd_1_grand_mare_en,
                    '3nd_2_grand_stallion' => $request->fs_3nd_2_grand_stallion_en,
                    '3nd_2_grand_mare' => $request->fs_3nd_2_grand_mare_en,
                    '3nd_3_grand_stallion' => $request->fs_3nd_3_grand_stallion_en,
                    '3nd_3_grand_mare' => $request->fs_3nd_3_grand_mare_en,
                    '3nd_4_grand_stallion' => $request->fs_3nd_4_grand_stallion_en,
                    '3nd_4_grand_mare' => $request->fs_3nd_4_grand_mare_en,
                ],
                'mother_side' => [
                    'parent' => $request->mare_en,
                    'grand_stallion' => $request->ms_grand_stallion_en,
                    'grand_mare' => $request->ms_grand_mare_en,
                    '2nd_1_grand_stallion' => $request->ms_2nd_1_grand_stallion_en,
                    '2nd_1_grand_mare' => $request->ms_2nd_1_grand_mare_en,
                    '2nd_2_grand_stallion' => $request->ms_2nd_2_grand_stallion_en,
                    '2nd_2_grand_mare' => $request->ms_2nd_2_grand_mare_en,
                    '3nd_1_grand_stallion' => $request->ms_3nd_1_grand_stallion_en,
                    '3nd_1_grand_mare' => $request->ms_3nd_1_grand_mare_en,
                    '3nd_2_grand_stallion' => $request->ms_3nd_2_grand_stallion_en,
                    '3nd_2_grand_mare' => $request->ms_3nd_2_grand_mare_en,
                    '3nd_3_grand_stallion' => $request->ms_3nd_3_grand_stallion_en,
                    '3nd_3_grand_mare' => $request->ms_3nd_3_grand_mare_en,
                    '3nd_4_grand_stallion' => $request->ms_3nd_4_grand_stallion_en,
                    '3nd_4_grand_mare' => $request->ms_3nd_4_grand_mare_en,
                ]
            ];
            $json_ar = [
                'father_side' => [
                    'parent' => $request->stallion_ar,
                    'grand_stallion' => $request->fs_grand_stallion_ar,
                    'grand_mare' => $request->fs_grand_mare_ar,
                    '2nd_1_grand_stallion' => $request->fs_2nd_1_grand_stallion_ar,
                    '2nd_1_grand_mare' => $request->fs_2nd_1_grand_mare_ar,
                    '2nd_2_grand_stallion' => $request->fs_2nd_2_grand_stallion_ar,
                    '2nd_2_grand_mare' => $request->fs_2nd_2_grand_mare_ar,
                    '3nd_1_grand_stallion' => $request->fs_3nd_1_grand_stallion_ar,
                    '3nd_1_grand_mare' => $request->fs_3nd_1_grand_mare_ar,
                    '3nd_2_grand_stallion' => $request->fs_3nd_2_grand_stallion_ar,
                    '3nd_2_grand_mare' => $request->fs_3nd_2_grand_mare_ar,
                    '3nd_3_grand_stallion' => $request->fs_3nd_3_grand_stallion_ar,
                    '3nd_3_grand_mare' => $request->fs_3nd_3_grand_mare_ar,
                    '3nd_4_grand_stallion' => $request->fs_3nd_4_grand_stallion_ar,
                    '3nd_4_grand_mare' => $request->fs_3nd_4_grand_mare_ar,
                ],
                'mother_side' => [
                    'parent' => $request->mare_ar,
                    'grand_stallion' => $request->ms_grand_stallion_ar,
                    'grand_mare' => $request->ms_grand_mare_ar,
                    '2nd_1_grand_stallion' => $request->ms_2nd_1_grand_stallion_ar,
                    '2nd_1_grand_mare' => $request->ms_2nd_1_grand_mare_ar,
                    '2nd_2_grand_stallion' => $request->ms_2nd_2_grand_stallion_ar,
                    '2nd_2_grand_mare' => $request->ms_2nd_2_grand_mare_ar,
                    '3nd_1_grand_stallion' => $request->ms_3nd_1_grand_stallion_ar,
                    '3nd_1_grand_mare' => $request->ms_3nd_1_grand_mare_ar,
                    '3nd_2_grand_stallion' => $request->ms_3nd_2_grand_stallion_ar,
                    '3nd_2_grand_mare' => $request->ms_3nd_2_grand_mare_ar,
                    '3nd_3_grand_stallion' => $request->ms_3nd_3_grand_stallion_ar,
                    '3nd_3_grand_mare' => $request->ms_3nd_3_grand_mare_ar,
                    '3nd_4_grand_stallion' => $request->ms_3nd_4_grand_stallion_ar,
                    '3nd_4_grand_mare' => $request->ms_3nd_4_grand_mare_ar,
                ]
            ];
            $translations = ['en' => json_encode($json_en), 'ar' => json_encode($json_ar)];
            $horse = Horse::where('id', $request->id)->first();
            $horse->update([
                'ancestors' => $translations,
            ]);

            $notification = createNotification('success', 'Ancestors Inserted Successfully');
            return redirect()->route('horses.index', $horse->type)->with($notification);

        } catch (\Throwable $throwable) {

            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->back()->withInput()->with($notification);


        }
    }

    public function horseGallery($id)
    {
        $horse = Horse::where('id', $id)->first();
        $gallery = Gallery::where('name', 'first')->first();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.horses.images', compact('horse'));
    }

    public function storeImages(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->toWebp(60);
            $path = 'backend_theme/horse/images/';
            $name = uniqid();
            $full_Path = $path . $name . '.' . 'webp';
            $image->save(public_path($full_Path));

            $file = new File();
            $file->fileable_id = $id;
            $file->fileable_type = Horse::class;
            $file->file = $full_Path;
            $file->extension = 'webp';
            $file->save();

            return response()->json(['message' => 'Uploaded Successfully'], '200');

        }

        return response()->json(['message' => 'something went Wrong'], '500');

    }

    public function destroy($id)
    {
        $image = File::where('id', $id)->first();
        $imagePath = public_path($image->file);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();
        $notification = createNotification('success', 'DeletedSuccessfully');
        return redirect()->back()->with($notification);
    }

    public function show($id)
    {
        $horse = Horse::where('id', $id)->first();
        return view('backend.horses.view', compact('horse'));
    }

    public function updateMainImage(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'main_image' => 'required|mimes:png,jpg,jpeg'
            ]);


            $obj = Horse::where('id', $request->id)->first();
            $main_image = $obj->image()->where('extension', 'main')->first();
            if ($obj && $main_image) {
                $imagePath = public_path($main_image->file);
                unlink($imagePath);
                $main_image->delete();
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->main_image)->toWebp(60);
            $path = 'backend_theme/horse/images/cover-main/';
            $name = time();
            $full_Path = $path . $name . '.' . 'webp';
            $image->save(public_path($full_Path));


            $file = new File();
            $file->fileable_id = $obj->id;
            $file->fileable_type = Horse::class;
            $file->file = $full_Path;
            $file->extension = 'main';
            $file->save();

            $notification = createNotification('success', 'Image Inserted Successfully');
            return redirect()->back()->with($notification);
        } catch (\Throwable $throwable) {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    public function updateCoverImage(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'cover_image' => 'required|mimes:png,jpg,jpeg'
            ]);

            $obj = Horse::where('id', $request->id)->first();
            $main_image = $obj->image()->where('extension', 'cover')->first();
            if ($obj && $main_image) {
                $imagePath = public_path($main_image->file);
                unlink($imagePath);
                $main_image->delete();
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->cover_image)->toWebp(60);
            $path = 'backend_theme/horse/images/cover-main/';
            $name = time();
            $full_Path = $path . $name . '.' . 'webp';
            $image->save(public_path($full_Path));


            $file = new File();
            $file->fileable_id = $obj->id;
            $file->fileable_type = Horse::class;
            $file->file = $full_Path;
            $file->extension = 'cover';
            $file->save();

            $notification = createNotification('success', 'Image Inserted Successfully');
            return redirect()->back()->with($notification);
        } catch (\Throwable $throwable) {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    public function updateInfo(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|numeric',
                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'owner_en' => 'required|string',
                'owner_ar' => 'required|string',
                'disc_en' => 'required|string',
                'disc_ar' => 'required|string',
                'type' => 'required|string',
                'age' => 'required|numeric',
            ]);

            $horse = Horse::where('id', $request->id)->first();

            $trans_name = $horse->getTranslations('name');
            $trans_disc = $horse->getTranslations('disc');
            $trans_owner = $horse->getTranslations('owner');

            $trans_n = ['en' => $request->name_en ?? $trans_name['en'], 'ar' => $request->name_ar ?? $trans_name['ar']];
            $trans_d = ['en' => $request->disc_en ?? $trans_disc['en'], 'ar' => $request->disc_ar ?? $trans_disc['ar']];
            $trans_o = ['en' => $request->owner_en ?? $trans_owner['en'], 'ar' => $request->owner_ar ?? $trans_owner['ar']];
            $horse->update([
                'name' => $trans_n,
                'disc' => $trans_d,
                'owner' => $trans_o,
                'type'=> $request->type ?? $horse->type,
                'age' => $request->age ?? $horse->age
            ]);


            $notification = createNotification('success', 'Info Inserted Successfully');
            return redirect()->back()->with($notification);

        } catch (\Throwable $throwable) {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->back()->with($notification);
        }

    }

    public function destroyHorse($id)
    {
        try {


            $horse = Horse::where('id', $id)->first();
            if ($horse && $horse->file) {

                foreach ($horse->file as $image)
                {
                    $imagePath = public_path($image->file);
                    unlink($imagePath);
                    $image->delete();
                }

            }
            $horse->delete();
            $notification = createNotification('success', 'Deleted Successfully');
            return redirect()->back()->with($notification);
        }catch (\Throwable $throwable)
        {
            $notification = createNotification('error', $throwable->getMessage());
            return redirect()->back()->with($notification);

        }

    }
}
