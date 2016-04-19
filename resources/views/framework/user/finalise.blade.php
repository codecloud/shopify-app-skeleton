@extends('layouts.bare')

@section('body')
    <div class="section">
        <div class="section-summary">
            <h1>Finalise Installation</h1>
            <p></p>
        </div>
        <div class="section-content">
            <div class="section-row">
                <div class="section-cell">
                    <form name="user.finalise" method="post" action="{{ $formAction }}">
                        <p><input type="text" name="name" id="name" /></p>
                        <p><input type="email" name="email_address" id="email_address" /></p>
                        <p><input type="text" name="shop_url" id="shop_url" value="{{ $shopUrl }}" readonly="readonly" /></p>
                        <p><button type="submit" class="btn btn-primary">Complete Installation</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection