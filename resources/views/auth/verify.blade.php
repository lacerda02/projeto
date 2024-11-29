<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Verificação</title>
    <style>
        /* Centraliza todo o conteúdo da página */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        /* Estilos para a área de sucesso e erro */
        .success {
            color: green;
            font-weight: bold;
            margin: 10px 0;
        }

        .error {
            color: rgb(77, 255, 0);
            margin: 10px 0;
        }

        /* Estilos do formulário */
        form {
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            width: 200px;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Estilo do botão para redirecionamento */
        .login-btn {
            margin-top: 20px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
        <h1>Verifique seu código</h1>

        <!-- Exibe mensagem de sucesso, se houver -->
        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Exibe erros de validação, se houver -->
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf
            <label for="code">Código de Verificação:</label>
            <input type="text" name="code" id="code" required>
            <button type="submit">Verificar</button>
        </form>

        <!-- Botão para redirecionar para a tela de login -->
        <a href="{{ route('login') }}">
            <button class="login-btn">Ir para o Login</button>
        </a>
    </div>
</body>
</html>
