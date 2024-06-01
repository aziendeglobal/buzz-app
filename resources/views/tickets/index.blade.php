@extends('layout.base')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tickets - Listado</h1>
    <button type="button" class="btn btn-secondary btn-sm float-end" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><span data-feather="filter"></span></button>
    <a class="btn btn-primary btn-sm float-end" role="button" href="{{ url('tickets/create' ) }}">crear</a>
</div>


@include('tickets.filter')


<div class="table-responsive">

    <table id="example" class="table table-striped text-center stripet my-4" style="width:100%">
        <thead class=" text-center dt-head-center">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Level</th>
                <th>Gif</th>
                <th>Done</th>
                <th>Creado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody class=" text-center">
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->name }}</td>
                <td>{{ $levels[$ticket->level] }}</td>
                <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ticket-gif-{{ $ticket->id }}">{{ $ticket->gif }} </a>
                </td>
                <td>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" {{ ($ticket->done?'checked':'') }} disabled>
                </td>
                <td>
                    @if($ticket->created_at)
                    {{ explode(' ',$ticket->created_at)[0] }}
                    @endif
                </td>
                <td>
                    <a class="btn btn-warning btn-sm" role="button" href="{{ url('tickets/'.$ticket->id ) }}">detalle</a>
                    <a class="btn btn-info btn-sm" role="button" href="{{ url('tickets/'.$ticket->id ).'/edit' }}">editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot class=" text-center dt-head-center">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Level</th>
                <th>Gif</th>
                <th>Done</th>
                <th>Creado</th>
                <th>Acción</th>
            </tr>
        </tfoot>
    </table>
</div>


@foreach($tickets as $ticket)
<!-- Modal -->
<div class="modal fade" id="ticket-gif-{{ $ticket->id }}" tabindex="-1" aria-labelledby="ticket-gif-label-{{ $ticket->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <iframe src="{{ $ticket->gif }}" title="{{ $ticket->name }}" width="100%"></iframe>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection