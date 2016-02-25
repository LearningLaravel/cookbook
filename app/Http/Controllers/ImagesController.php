<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ImageFormRequest;

use Image;

class ImagesController extends Controller
{
    public function store(ImageFormRequest $request)
    {

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $file->move(public_path().'/images/', $name);

            $imagePath = public_path().'/images/'.$name;

            $image = Image::make($imagePath)->resize(1000, 250)->greyscale()->save();

            return redirect('/')->with('status', 'Your image has been uploaded successfully!');
        }

    }
}
