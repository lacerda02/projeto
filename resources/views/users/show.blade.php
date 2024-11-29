@extends('main')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h1>Detalhes do Incidente</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $incident->description }}</h5>
                <p class="card-text">Data de Envio: {{ $incident->submission_date }}</p>
                <p class="card-text">Status: {{ $incident->status }}</p>
                <p class="card-text">Tipo de Incidente: {{ $incident->incidentType->name }}</p>
                <p class="card-text">Usuário: {{ $incident->user->name }}</p>
                <p class="card-text">Departamento: {{ $incident->user->department }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
