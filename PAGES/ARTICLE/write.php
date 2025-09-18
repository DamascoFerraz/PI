<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Exemplo de pagina";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src='".$pathToRoot."JS/theme_control.js'></script>";

    // loading aside
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";
?>

            <br>
            <div class="container-fluid">
                <hgroup>
                    <h3>Escrevendo um artigo:</h3>
                    <ol>
                        <li>Dê um nome ao seu artigo:</li>
                            <p>algo simples e dinamico para chamar atenção de outras pessoas. ele deve ser único</p>
                        <li>Dê uma descrição do artigo:</li>
                            <p>descreva brevemente oque é dito no artigo.</p>
                        <li>Escreva seu artigo:</li>
                            <p>artigos são formatados em MarkDown, aprenda sobre a formatação markdown <a href="markdown.php" target="_blank">aqui</a></p>
                        <li>Confirme sua senha e publique!</li>
                            <p>estão todos esperando para ler!</p>
                    </ol>
                </hgroup>
            </div>
            <hr>
            <div class="container-fluid">
                <form action="../../PHP/process_article.php"  method="POST">
                    <label for="title">Titulo:</label>
                    <input type="text" name="title" required placeholder="Titulo do seu artigo" value="Meu primeiro artigo">

                    <label for="description">Descrição:</label>
                    <input type="text" name="description" required placeholder="Breve descrição do seu artigo" value="Lorem ipsum dolor sit amet consectetur adipisicing elit.">

                    <hr>

                    <textarea name="content" id="content" rows="10" required placeholder="conteudo do seu artigo"># isso é um título 
## isso é um subtítulo  
abaixo, temos um parágrafo de exemplo:  
Lorem ipsum dolor sit amet consectetur adipisicing elit.  
Tempora adipisci minima alias rem molestiae, eius cupiditate inventore est veritatis dolor dolorem quae repellendus reiciendis corrupti ut!  
Tenetur ex sapiente dolorum!...  

texto com *itálico*  
texto com **negrito**  
texto com ***itálico e negrito***  

- item de lista 
- item de lista, 
    - item de sublista. 
- item de lista 

exemplo de citação:
> "isso é uma citação."
> - item de lista dentro de citação

link exemplo:  
[Google](https://www.google.com)  
  
imagem exemplo:  
"![nome da imagem](link da imagem)"   
  
![ imagem_exemplo ](https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSB7eKg79YwlWaakHgNairxt9UoqQiTL9eo7g&s)
</textarea>
                    <br>
                    
                    <input type="hidden" name="author" value="<?php echo $_SESSION['user']['username']; ?>">
                    <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="hidden" name="author_position" value="<?php echo $_SESSION['user']['position']; ?>">
                    <hr>
                    <footer>
                        <button class="secondary" type="submit" formaction="preview.php">ver preview</button>
                    </footer>
                    <hr>
                    <footer>
                        <button type="submit">Postar</button>
                    </footer>
                </form>
            </div>
        </section>
    </main>

<?php
// loading modal (return messages)
require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

// loading modal control script
echo "<script src='".$pathToRoot."JS/modal_control.js'></script>" ;

// loading footer
require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>