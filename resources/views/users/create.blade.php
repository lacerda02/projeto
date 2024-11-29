@extends('main')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="main-panel">
            <div class="content-wrapper">
                <h1>Adicionar Usuário</h1>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direction_id">Direção:</label>
                        <select name="direction_id" id="direction_id" class="form-control" required>
                            <option value="">Selecione</option>
                            @foreach ($directions as $direction)
                                <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="is_admin">Nível de Acesso:</label>
                        <select name="is_admin" id="is_admin" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="0">Administrador</option>
                            <option value="1">Técnico</option>
                            <option value="2">Usuário</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contato:</label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="photo">Foto:</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

@endsection
