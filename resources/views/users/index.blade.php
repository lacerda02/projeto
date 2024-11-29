@extends('main')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h1>Lista de Usuários do Aplicativo</h1>

        <table class="table table-striped table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">Excluir</button>
                        </td>
                    </tr>

              <!-- Modal de Edição -->
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Editar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm{{ $user->id }}" action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="editUserName{{ $user->id }}">Nome:</label>
                        <input type="text" class="form-control" id="editUserName{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="editUserEmail{{ $user->id }}">Email:</label>
                        <input type="email" class="form-control" id="editUserEmail{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Mudanças</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>


                    <!-- Modal de Exclusão -->
                <!-- Modal de Exclusão -->
<div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Excluir Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir o usuário {{ $user->name }}?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function submitEditForm(userId) {
        // Envia a solicitação de atualização via AJAX
        $.ajax({
            type: 'POST',
            url: $('#editUserForm' + userId).attr('action'),
            data: $('#editUserForm' + userId).serialize(),
            success: function (response) {
                // Fecha o modal após a atualização
                $('#editUserModal' + userId).modal('hide');
                // Adicione qualquer lógica adicional necessária após a atualização
            },
            error: function (error) {
                // Trate os erros, se necessário
            }
        });
    }

    function deleteUser(userId) {
    $.ajax({
        type: 'DELETE',
        url: '/users/' + userId, // Inclua o ID do usuário
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function (response) {
            if (response.success) {
                $('#deleteUserModal' + userId).modal('hide');
                alert(response.message); // Exibe mensagem de sucesso
                location.reload(); // Recarrega a página para atualizar a lista de usuários
            } else {
                alert('Erro: ' + response.message);
            }
        },
        error: function (error) {
            alert('Erro ao excluir usuário. Tente novamente.');
            console.error(error.responseJSON.error); // Exibe detalhes do erro no console
        }
    });
}

</script>
