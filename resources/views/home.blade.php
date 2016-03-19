@extends('layouts.app')

@section('content')

<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">Laravel 5</div>

                <div><img src="/images/chap1-pic24.png" width="100%"/></div>


                <div class="panel-body">

                    <form method="POST" action="/upload" enctype="multipart/form-data">

                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="image">Choose an image</label>
                            <input type="file" id="image" name="image">
                        </div>

                        <button type="submit" class="btn btn-default ladda-button" data-style="expand-left" data-size="s" data-color="purple">Upload</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
