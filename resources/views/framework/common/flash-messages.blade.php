@if(Session::has('msg.ok'))
    <div class="row">
        <div class="col-sm-12">
            <p class="alert alert-success flash-message">{{ Session::get('msg.ok') }}</p>
        </div>
    </div>
@endif
@if(Session::has('msg.warning'))
    <div class="row">
        <div class="col-sm-12">
            <p class="alert alert-warning flash-message">{{ Session::get('msg.warning') }}</p>
        </div>
    </div>
@endif
@if(Session::has('msg.error'))
    <div class="row">
        <div class="col-sm-12">
            <p class="alert alert-danger flash-message">{{ Session::get('msg.error') }}</p>
        </div>
    </div>
@endif