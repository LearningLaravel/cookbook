@extends('layouts.app')
@section('title', 'About')

@section('content')

    <div class="container">
        <div class="content">
            <div class="title">About Page</div>
            <div>
                <div id="files" class="files">
                    <div id="testimage"><img id="image" src="/images/testimage.png" alt="test image"></div>
                </div>
                 <span class="btn btn-info btn-file">
                         Upload an image
                            <input id="fileupload" class="upload" type="file" name="files[]">
                 </span>
                <div id="progress" class="progress" style="display:none;">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
            </div>
        </div>
    </div>

@endsection