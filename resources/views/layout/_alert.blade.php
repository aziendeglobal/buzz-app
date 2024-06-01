@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('message-error'))
<div class="alert alert-danger" role="alert">
    {!! Session::get('message-error') !!}
</div>
@endif

@if (Session::has('message-success'))
<div class="alert alert-success" role="alert">
    {!! Session::get('message-success') !!}
</div>
@endif