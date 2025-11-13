<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Tutorial markdown";

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
                    <h2>Formatação MarkDown</h2>
                    <p>Deixando seus textos bonitos!</p>
                    <br>
                    <h3>Oque é MarkDown?</h3>
                    <p>Markdown é uma linguagem voltada para formatação de textos baseada em marcadores, deixando a escrita facil sem a necessidade de tirar suas mãos do teclado para deixar o texto mais agradavel aos olhos</p>
                    <br>
                    <h3>Elementos do texto:</h3>
                    <ul>
                        <hr>
                        <li><b>Titulos:</b></li>
                        <p>adicionando "# " (hashtag) antes de qualquer texto irá indicar um titulo, voce pode indicar o nivel do titulo pela quantidade de hashtags (até 6).</p>
                        <p><b>atenção</b> é importante que após os hashtags aja um espaço em branco separando do nome do titulo.</p>
                        <p><b>Escrita:</b></p>
                        <code><mark># </mark>nome do titulo 1<br></code><br>
                        <code><mark>## </mark>nome do titulo 2<br></code><br>
                        <code><mark>### </mark>nome do titulo 3</code><br>
                        <br>
                        <p><b>Resultado:</b></p>
                        <h1>Nome do Titulo 1</h1>
                        <h2>Nome do Titulo 2</h2>
                        <h3>Nome do Titulo 3</h3>
                        <br>
                        
                        <hr>
                        <li><b>Quebra de linha</b></li>
                        <p>para quebrar uma linha a mais, passando para outro paragrafo. ao final da linha adicione dois espaços em branco "  ".</p>
                        <p><b>Escrita:</b></p>
                        <code>
                            texto exemplo<br>
                            com varias linhas.<mark> </mark><mark> </mark><br>
                            outro texto.
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <p>texto exemplo<br>com varias linhas</p>
                        <p>outro texto.</p>

                        <hr>
                        <li><b>Texto com efeito:</b></li>
                        <p>para adicionar efeito a um texto, adicione "*" (asteriscos) em volta do texto</p>
                        <p><b>importante:</b> dependendo da quantidade de asteriscos, ira fazer um efeito diferente</p>
                        <p><b>Escrita:</b></p>
                        <code>
                            texto com <mark>*</mark>itálico<mark>*</mark><br>
                            texto com <mark>**</mark>negrito<mark>**</mark><br>
                            texto com <mark>***</mark>itálico e negrito<mark>***</mark><br>
                        </code>
                        <p><b>Resultado</b></p>
                            <p>texto com <i>italico</i></p>
                            <p>texto com <b>negrito</b></p>
                            <p>texto com <i><b>italico e negrito</b></i></p>
                        
                        <hr>
                        <li><b>Menções:</b></li>
                        <p>Assim como um titulo, para adicionar uma menção, coloque "> " (sinal maior que) antes de qualquer texto</p>
                        <p><b>importante:</b> para adicionar diversas linhas da mesma menção, apenas siga usando o sinal antes de cada linha. <br>
                        Menções podem ser colocadas uma dentro da outra, como nos titulos, adicione mais do marcador para aninha-los ">> "</p>
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                            <mark>> </mark>"O trabalho não é ruim. Ruim é ter de trabalhar!"<br>
                            <mark>> </mark><br>
                            <mark>>> </mark>-Don Ramon <br>
                            <br>
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <blockquote>
                            <p>"O trabalho não é ruim. Ruim é ter de trabalhar!"</p>
                            <p></p>
                            <blockquote><p>-Don Ramon <br></p></blockquote></blockquote>

                        <hr>
                        <li><b>Listas</b></li>
                        <p>para criar uma lista, insira um dos seguintes marcadores antes de cada linha de item (=.-.*)<br>
                        Você pode criar listas dentro de listas colocando 3 espaços em branco " " (uma vez da tecla TAB insere-os automaticamenta) antes do marcador</p>
                        
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                            <mark>* </mark>primeiro item <br>
                            <mark>* </mark>segundo item <br>
                            <mark>‎ ‎ ‎ * </mark>primeiro item de sublista <br>
                            <mark>‎ ‎ ‎ * </mark>segundo item de sublista <br>
                            <mark>+ </mark>terceiro item (outro marcador) <br>
                            <mark>- </mark>quarto item (outro marcador) <br>
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <ul style="list-style-type: decimal !important;">
                            <li>primeiro item</li>
                            <li>segundo item
                            <ol>
                                <li>primeiro item de sublista</li>
                                <li>segundo item de sublista</li>
                            </ol>
                            </li>
                            <li> terceiro item (outro marcador)</li>
                            <li>quarto item (outro marcador)</li>
                        </ul>

                        <hr>
                        <li><b>Links:</b></li>
                        <p>para inserir links dentro de textos, você pode utilizar o metodo markdown colocando o texto que quiser mascarar o link dentro de colchetes "[ ]" e logo em seguida o link em parêntesis "( )"</p>
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                            acesse <mark>[</mark>google<mark>](</mark>google.com<mark>)</mark>.
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <p>acesse <a href="https://google.com">google</a></p>

                        <hr>
                        <p><b>Por fim... imagens:</b></p>
                        <p>para adicionar imagens, é o mesmo que links, mas o com uma exclamação "!" antes de tudo, o texto inserido antes do link da imagem só sera exibido se tiver uma falha ao carregar a imagem</p>
                        <p><b>Importante:</b> certifique-se de que é um link <b>de imagem</b> e nao link para um site onde está a imagem</p>
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                        <mark>!</mark>[Logo do Markdown](https://markdown.net.br/assets/img/basic-syntax/markdown-logo-small.png)
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <img src="https://markdown.net.br/assets/img/basic-syntax/markdown-logo-small.png" alt="Logo do markdown">
                        <p><b>Resultado com erro:</b></p>
                        <img src="Tá fuxicando o html daqui por que? safado!!!" alt="Logo do markdown">
                    </ul>
                    <hr>
                    <h2>Parabens!</h2>
                    <p>voce acabou o tutorial <b>basico</b> de markdown, e aprendeu o suficiente para escrever seu primeiro artigo, para mais dicas uteis e coisas nao mencionadas nesse breve tutorial acesse o <a href="https://markdown.net.br/sintaxe-basica/">Tutorial completo oficial da MarkDown</a></p>
                </hgroup>
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