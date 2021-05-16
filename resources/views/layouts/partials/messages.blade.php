@if ($message = Session::get('success'))
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div id="alert-succes" class="alert alert-success alert-block col-md-4">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="alert alert-danger alert-block col-md-4">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="alert alert-warning alert-block col-md-4">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            {{ $error }}
        </div>
    @endforeach
@endif   