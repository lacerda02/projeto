@extends('main')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h1>Lista de Denúncias Anonimas</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>Descrição da Denúncia</th>
                      
                        <th>Status</th>
                        <th>Anexo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $denuncia)
                        <tr>
                            <td>{{ $denuncia->type }}</td>
                            <td>{{ $denuncia->description }}</td>
                           
                            <td>
                                <form action="" method="GET">
                                    @csrf
                                    @method('patch')
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="@if($denuncia->status === 'pendente') text-danger @else text-success @endif custom-select" onchange="confirmStatusChange(this)">
                                        <option value="pendente" {{ $denuncia->status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                                        <option value="resolvido" {{ $denuncia->status === 'resolvido' ? 'selected' : '' }}>Resolvido</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                @if($denuncia->anexo)
                                    <img src="{{ asset('storage/' . $denuncia->anexo) }}" alt="Imagem da Denúncia" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                @else
                                    Nenhuma imagem
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Editar</a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteReportModal{{ $denuncia->id }}">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">

        </div>
    </div>
</div>

@foreach($reports as $denuncia)
    <!-- Modal de Exclusão -->
    <div class="modal fade" id="deleteReportModal{{ $denuncia->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteReportModalLabel{{ $denuncia->id }}" aria-hidden="true">
        <!-- ... (seu código modal) ... -->
    </div>
@endforeach

<script>
    function deleteReport(reportId) {
        // Implemente a lógica para excluir a denúncia via AJAX, se necessário
        // Você pode usar o mesmo padrão usado para a exclusão de usuários
    }

    function confirmStatusChange(selectElement) {
        var status = selectElement.value;
        var confirmationMessage = "Tem certeza que deseja alterar o status para '" + status + "'?";
        if (confirm(confirmationMessage)) {
            selectElement.form.submit();
        } else {
            // Reverta a seleção se o usuário cancelar
            var currentValue = selectElement.getAttribute("data-current-value");
            selectElement.value = currentValue;
        }
    }
</script>

@endsection
