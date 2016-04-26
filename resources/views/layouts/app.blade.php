@extends('layouts.base')

@section('layoutStyles')
    <link href="/third-party/eaff/css/seaff.css" rel="stylesheet" type="text/css" />
    <link href="/css/eaff-ext.css" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    @yield('content')
@endsection

@section('layoutScripts')
    <script src="/js/forms.js"></script>
@endsection