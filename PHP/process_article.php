<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    $filename = 'article_' . time() . '.md'; // Gera um nome único para o arquivo

    // TODO (Gilberto) criar link com banco de dados e salvar o artigo

    file_put_contents('../ASSETS/ARTICLES/'.$filename, $content);
    file_put_contents('../ASSETS/ARTICLES/'.$filename, $content);
    echo "Artigo salvo com sucesso!";
}
?>