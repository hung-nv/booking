@if(Session::has('success'))
    <div id="alert_container">
        <div class="alert alert-info">
            {{Session::get('success')}}
        </div>
    </div>
@elseif(Session::has('error'))
    <div id="alert_container">
        <div class="alert alert-warning">
            <strong>Warning!</strong> {{ Session::get('error') }}
        </div>
    </div>
@endif