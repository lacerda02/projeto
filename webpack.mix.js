const mix = require('laravel-mix');

// Compilar o arquivo SASS (se você estiver utilizando SASS)
mix.sass('resources/sass/app.scss', 'public/css');

// Compilar o JavaScript
mix.js('resources/js/app.js', 'public/js')
   .vue()  // Caso esteja usando Vue.js
   .extract();  // Extrair bibliotecas comuns para melhorar o cache

// Minificar os arquivos CSS e JS para produção
if (mix.inProduction()) {
    mix.version(); // Para versionamento de arquivos e cache busting
}
