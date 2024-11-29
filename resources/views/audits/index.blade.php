@extends('main')

@section('content')


<div class="main-panel">
    <div class="content-wrapper">
        <h1>Controlo de logs de auditoria</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-4">
                <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Evento</th>
                <th>Modelo</th>
                <th>Alterações</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->id }}</td>
                <td>{{ $audit->user->name ?? 'N/A' }}</td>
                <td>{{ $audit->event }}</td>
                <td>{{ class_basename($audit->auditable_type) }}</td>
                <td>
                    <pre>{{ json_encode($audit->getModified(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </td>
                <td>{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $audits->links() }}
    </div>

</div>

<div class="d-flex justify-content-center">

</div>
</div>
</div>
@endsection
