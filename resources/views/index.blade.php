@extends('layout.base')


@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-12 col-lg-6 text-center">
        <h2 class="h2">Tickets Completados</h2>
        <canvas class="my-4 w-100" id="myChartDone" width="900" height="380"></canvas>

    </div>
    <div class="col-12 col-lg-6 text-center">
        <h2 class="h2">Tickets por Nivel de Dificultad</h2>
        <canvas class="my-4 w-100" id="myChartLevel" width="900" height="380"></canvas>

    </div>
</div>
@endsection

@section('contentjs')
<script>
    // Graphs
    const ctxDone = document.getElementById('myChartDone')
    // eslint-disable-next-line no-unused-vars
    const myChartDone = new Chart(ctxDone, {
        type: 'pie',
        data: {
            labels: [
                'SI',
                'NO',
            ],
            datasets: [{
                label: '% de tickets',
                data: [
                    {{ $done['si'] }},
                    {{ $done['no'] }},
                ],
                borderWidth: 1,
                backgroundColor: ['#1F618D', '#CB4335'],
            }]
        },

    });


    // Graphs
    const ctxLevel = document.getElementById('myChartLevel')
    // eslint-disable-next-line no-unused-vars
    const myChartLevel = new Chart(ctxLevel, {
        type: 'pie',
        data: {
            labels: [
                'Muy Facil',
                'Facil',
                'Normal',
                'Dificil',
                'Muy Dificil',
            ],
            datasets: [{
                label: '% de tickets',
                data: [
                    {{ $levels['muyfacil'] }},
                    {{ $levels['facil'] }},
                    {{ $levels['normal'] }},
                    {{ $levels['dificil'] }},
                    {{ $levels['muydificil'] }},
                ],
                borderWidth: 1,
                backgroundColor: ['#1F618D', '#CB4335', '#27AE60', '#884EA0', '#D35400'],
            }]
        },

    });
</script>

@endsection