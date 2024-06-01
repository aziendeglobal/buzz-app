<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="name" name="name"  placeholder="nombre" value="{{ (isset($ticket)?$ticket->name:'') }}">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ (isset($ticket)?$ticket->description:'') }}</textarea>
</div>
<div class="mb-3">
    <label for="level" class="form-label">Nivel de dificultad</label>
    <select class="form-select" id="level" name="level" aria-label="Seleccione nivel de dificultad">
        <option value="0">Seleccione nivel de dificultad</option>
        @foreach($levels as $key => $level)
        <option value="{{ $key }} " {{ ((isset($ticket) && $ticket->level == $key )?'selected':'') }}>{{ $level }}</option>
        @endforeach
    </select>
</div>

<div class="row mb-3 ">

    <div class="form-check mb-3 col-12 col-lg-6">
        <label for="done" class="form-label">&nbsp;</label>
        <br>
        <input class="form-check-input ms-1" type="checkbox" value="" id="done" name="done" {{ ((isset($ticket) && $ticket->done )?'checked':'') }}>
        <label class="form-check-label ms-2" for="done">
            Completado
        </label>
    </div>

    @if(isset($ticket) && $ticket->gif )
    <div class="form-check mb-3 col-12 col-lg-6">
        <label class="form-label">&nbsp;</label>
        <br>
        <iframe src="{{ $ticket->gif }}" title="{{ $ticket->name }}"></iframe>
    </div>
    @endif
</div>

