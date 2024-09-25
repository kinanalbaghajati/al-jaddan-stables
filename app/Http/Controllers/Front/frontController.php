<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Horse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class frontController extends Controller
{

    public function index()
    {
        $firstsection = \App\Models\Content::where('name', 'first')->first();
        $secondsection = \App\Models\Content::where('name', 'second')->first();
        $title = \App\Models\Content::where('name', 'title')->first();
        $gallery = \App\Models\Gallery::where('name', 'first')->first();


        return view('frontend.index', compact('firstsection', 'secondsection', 'gallery','title'));
    }

    public function sendMail(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:30|max:300'
            ]);
            Mail::to('Info@aljadaanstables.com')->send(new ContactMail(['email' => $request->email, 'name' => $request->name, 'message' => $request->message]));

            return redirect('/#home-contactus')->with('message_suc', "Email Sent Successfully");

        } catch (\Throwable $throwable) {
            $notification = $throwable->getMessage();
            return redirect('/#home-contactus')->with('message_danger', $notification);
        }

    }

    public function horsesIndex($type)
    {
        $horses = Horse::where('type',$type)->take(12)->get();

        return view('frontend.stallions',compact('horses','type'));
    }

    public function details($id)
    {

        $horse = Horse::where('id',$id)->first();

        return view('frontend.horse-details',compact('horse'));
    }

    public function contact()
    {
        return view('frontend.contactus');
    }
}

