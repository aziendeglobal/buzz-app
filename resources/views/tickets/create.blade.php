@extends('layout.base')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ticket: Crear</h1>
</div>

<form class="row g-3" method="POST" action="{{ url('/tickets') }}">
    @csrf
    @include('tickets.fields')
    <div class="col-12">
        <button type="submit" class="btn btn-primary float-end">Guardar</button>
    </div>
</form>
@endsection