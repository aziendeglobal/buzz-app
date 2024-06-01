@extends('layout.base')


@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ticket: Detalle</h1>
</div>

<form class="row g-3">
    <fieldset disabled>
        @include('tickets.fields')
    </fieldset>
    <div class="col-12">
        <a href="{{ url('tickets') }}" class="btn btn-primary float-end">Volver</a>
        <a href="{{ url('tickets/'.$ticket->id.'/edit') }}" class="btn btn-info mx-4 float-end">Editar</a>
    </div>
</form>
@endsection