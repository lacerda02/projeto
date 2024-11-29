<!-- resources/views/users/edit.blade.php -->

@extends('main')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h1>Editar Usuário</h1>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Campos do formulário para edição -->
    <div class="form-group">
        <label for="editUserName">Nome:</label>
        <input type="text" class="form-control" id="editUserName" name="name" value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="editUserEmail">Email:</label>
        <input type="email" class="form-control" id="editUserEmail" name="email" value="{{ $user->email }}">
    </div>
    <!-- Adicione mais campos conforme necessário -->

    <button type="submit" class="btn btn-primary">Salvar Mudanças</button>
</form>

        </div>
    </div>
@endsection
