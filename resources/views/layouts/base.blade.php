<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - Imagine Apps</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="Imagine Apps" />
    @yield('metaTags')

    <link href="/assets/third-party/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- WebApp styles -->
    <link href="/assets/app/css/global.css" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body>
@yield('body')

<script type="text/javascript" src="/assets/third-party/jquery/core/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="/assets/third-party/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">var csrf_token = '{{ csrf_token() }}';</script>
@yield('scripts')
</body>
</html>
