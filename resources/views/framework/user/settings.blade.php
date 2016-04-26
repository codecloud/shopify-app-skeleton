@extends('layouts.app')

@section('body')
    <div class="section">
        <div class="section-summary">
            <h1>Account Settings</h1>
            <p>Manage your general account settings here.</p>
        </div>
        <div class="section-content">
            <div class="section-row">
                <div class="section-cell">
                    <form name="user.settings" method="post" action="">
                        {!! csrf_field() !!}
                        <label for="owner_name">Your Name</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{ $ownerName }}" />
                        <label for="email_address" data-toggle="tooltip" data-placement="left" title="We'll send important messages and replies to support requests to this email address - so make sure it's correct!">Your Email Address <span class="glyphicon glyphicon-info-sign"></span></label>
                        <input type="email" name="email_address" id="email_address" value="{{ $emailAddress }}" />

                        <label for="shop_url">Shop URL</label>
                        <input type="text" name="shop_url" id="shop_url" value="{{ $shopUrl }}" readonly="readonly" />

                        <p><button type="submit" class="btn primary">Save Changes</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Account Settings
@endsection