<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ImageFormRequest;

use Image;
use Illuminate\Support\Facades\Input;
use Response;
use Alert;

class ImagesController extends Controller
{
    public function store(ImageFormRequest $request)
    {

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $file->move(public_path() . '/images/', $name);

            $imagePath = public_path() . '/images/' . $name;

            $image = Image::make($imagePath)->resize(1000, 250)->greyscale()->save();

            return redirect('/')->with('status', 'Your image has been uploaded successfully!');
        }

    }

    public function storeImage()
    {

        $files = Input::file('files');

        $json = array(
            'files' => array()
        );

        foreach ($files as $file) {
            $destination = 'images';
            $size = $file->getSize();
            $filename = 'testimage';
            $extension = 'png';
            $fullName = $filename . '.' . $extension;
            $pathToFile = $destination . '/' . $fullName;
            $upload_success = Image::make($file)->encode('png')->save($destination . '/' . $fullName);

            if ($upload_success) {
                $json['files'][] = array(
                    'name' => $filename,
                    'size' => $size,
                    'url' => $pathToFile,
                    'message' => 'Uploaded successfully'
                );
                return Response::json($json);
            } else {
                $json['files'][] = array(
                    'message' => 'error uploading images',
                );
                return Response::json($json, 202);
            }
        }
    }

    public function storeCroppedImage()
    {
        $files = Input::all();

        if ($files['cropped-image'] != "") {

            $file = $files['cropped-image'];

            $destination = 'images';
            $filename = 'testimage';
            $extension = 'png';
            $fullName = $filename . '.' . $extension;

            $image = Image::make($file)->encode('png')->save($destination . '/' . $fullName);

            Alert::success('Image has been cropped successfully!', 'Success!')->autoclose(2000);

            return redirect('/contact');

        } else if (isset($files['uploaded-image'])) {

            $file = $files['uploaded-image'];
            $destination = 'images';
            $filename = 'testimage';
            $extension = 'png';
            $fullName = $filename . '.' . $extension;
            $image = Image::make($file)->encode('png')->save($destination . '/' . $fullName);

            Alert::success('Image has been uploaded successfully!', 'Success!')->autoclose(2000);

            return redirect('/contact');

        } else {

            Alert::error('There is an error', 'Error')->autoclose(2000);

            return redirect('/contact');
        }
    }
}
