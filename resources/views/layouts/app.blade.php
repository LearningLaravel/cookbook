<html>
<head>
    <title> @yield('title') </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/ladda.min.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    <link rel="stylesheet" href="/css/cropper.min.css">
    <link rel="stylesheet" href="/css/app.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="/js/cropper.min.js"></script>
    <script src="/js/crop.js"></script>
    <script src="/js/load-image.all.min.js"></script>
    <script src="/js/canvas-to-blob.min.js"></script>
    <!-- jQuery File Upload Plugin -->
    <script src="/js/jquery.ui.widget.js"></script>
    <script src="/js/jquery.iframe-transport.js"></script>
    <script src="/js/jquery.fileupload.js"></script>
    <script src="/js/jquery.fileupload-process.js"></script>
    <script src="/js/jquery.fileupload-image.js"></script>

    <meta name="_token" content="{{ csrf_token() }}" />

    <script src="/js/upload.js"></script>

    <script src="/js/parsley.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

@include('shared.navbar')

@yield('content')

<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<script src="/js/spin.min.js"></script>
<script src="/js/ladda.min.js"></script>
<script src="/js/custom_script.js"></script>
</body>
</html>