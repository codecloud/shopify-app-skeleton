@extends('layouts.base')

@section('layoutStyles')
    <link href="/css/layouts/bare.css" rel="stylesheet" type="text/css" />
    <link href="/third-party/eaff/css/seaff.css" rel="stylesheet" type="text/css" />
    <link href="/css/eaff-ext.css" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <div class="bare-outer">
        <div class="bare-middle">
            <div class="bare-inner">
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@section('layoutScripts')
    <script src="/js/forms.js"></script>
@endsection