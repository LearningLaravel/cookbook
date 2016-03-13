<html>
<head>
    <title> @yield('title') </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/ladda.min.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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