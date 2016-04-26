@extends('layouts.base')

@section('body')
    <div class="container">
        <div class="col-sm-4 col-sm-4-offset">
            <p><a href="{{ $installUrl }}?shop=code-cloud-demo" class="btn btn-primary">Install Application</a></p>
            <p><a href="/login-user?id=1">Auto-login user 1</a></p>
        </div>
    </div>
@endsection

@section('title')
    Default Homepage
@endsection