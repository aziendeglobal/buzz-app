@extends('layout.base')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ticket: Editar</h1>
</div>

<form class="row g-3" method="POST" action="{{ url('/tickets/'. $ticket->id ) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="method" value="PUT">
    @include('tickets.fields')
    
    <div class="col-12">
        <button type="submit" class="btn btn-primary mx-4 float-end">Guardar</button>

</form>

<form class="mx-4" method="POST" action="{{ url('/tickets/'. $ticket->id ) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger float-end">Borrar</button>
</form>

</div>
@endsection