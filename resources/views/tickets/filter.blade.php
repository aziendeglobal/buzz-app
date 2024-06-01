<div class="align-items-center pt-3 pb-2 mb-3 bg-light collapse" id="collapseFilter">
    <h3 class="h3">Filtro</h3>
    <form action="{{ url('tickets-filter') }}" method="POST">
        @csrf
        <div class="row">
            <div class="mb-3 col-12 col-lg-6">
                <label for="level" class="form-label">Nivel de dificultad</label>
                <select class="form-select" aria-label="Seleccione nivel" id="level" name="level">
                    <option value="">Seleccione nivel</option>
                    @foreach($levels as $key=> $levelValue)
                    <option value="{{ $key }}" {{ ((isset($level) && $level == $key)?'selected':'') }}>{{ $levelValue }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-12 col-lg-6">
                <label for="done" class="form-label">Completados</label>
                <select class="form-select" aria-label="Seleccione una opcion" id="done" name="done">
                    <option value="">Todos</option>
                    <option value="1" {{ ((isset($done) && $done == 1)?'selected':'') }}>SI</option>
                    <option value="2" {{ ((isset($done) && $done == 2)?'selected':'') }}>NO</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-lg-4">
                <label for="level" class="form-label">Fecha creacion</label>
                <input type="date" class="form-control" id="created" name="created" value="{{ ((isset($created))?$created:'') }}">
            </div>

            <div class="mb-3 col-12 col-lg-4">
                <label for="level" class="form-label">Fecha creacion - Desde</label>
                <input type="date" class="form-control" id="created_from" name="created_from" value="{{ ((isset($created_from))?$created_from:'') }}" >
            </div>
            <div class="mb-3 col-12 col-lg-4">
                <label for="level" class="form-label">Fecha creacion - Hasta</label>
                <input type="date" class="form-control" id="created_to" name="created_to" value="{{ ((isset($created_to))?$created_to:'') }}" >
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 ">
                <button type="submit" class="btn btn-secondary float-end">Filtrar</button>
            </div>
        </div>
    </form>
</div>