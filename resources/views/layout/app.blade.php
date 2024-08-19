<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap@5.0.2_dist_css_bootstrap.min.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    @yield('content')

    <script src="{{ asset('assets/js/bootstrap@5.0.2_dist_js_bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/code.jquery.com_jquery-3.7.0.min.js') }}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>
</html>
