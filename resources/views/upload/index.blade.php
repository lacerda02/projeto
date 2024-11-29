<!-- resources/views/upload.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagem</title>
</head>
<body>
    <h1>Fazer Upload de Imagem</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="description">Descrição:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="image">Imagem:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>

        <div>
            <button type="submit">Fazer Upload</button>
        </div>
    </form>
</body>
</html>
