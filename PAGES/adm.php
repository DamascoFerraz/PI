<!-- TODO adm actions work -->
<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ASSETS/NEABI_LOGO_WHITE.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/mainpage.css">
    <title>CNEABI</title>
    <?php
        session_start();
        // checar se o usuario esta logado mas nao tem permissao de acesso
        if(!isset($_SESSION['user'])){
            header('Location: ../verify.php?r=Faca%20Log-in%20para%20acessar');
            die();
        };
        // checar se o usuario não é administrador
        if ($_SESSION['user']['position'] != "administrador") {
            header('Location: home.php?r=Voce%20nao%20tem%20permissao%20para%20acessar%20esta%20pagina');
            die();
        };
        // (r) return message for modal
        if (!isset($_GET['r'])){
            $_GET['r'] = '';
        };
        echo "<script>var r = '".$_GET['r']."';</script>";
    ?>
</head>
<body>
    <!------------------------------------------- HEADER ------------------------------------------->
    <header>
        <div class="container">
            <div class="title">
                <div><img id="logo" width=50rem src="../ASSETS/NEABI_LOGO_DARK.png" alt="NEABI_logo"></div>
                <hgroup>
                    <h3>CNEABI</h3>
                    <p>Central do Nucleo de Estudos Afro-Brasileiros e Indigenas</p>
                </hgroup>
            </div>

            <nav>
                <button class="outline contrast theme-togle" onclick="darkMode()"><i id="theme-icon" class="fa-regular fa-moon"></i></button>
                <?php
                    if (isset($_SESSION['user'])) {
                        echo '<button class="outline contrast" onclick="window.location.replace('."'".'../log_off.php'."'".')">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></button>';
                    } else {
                        echo '<button class="outline contrast" onclick="window.location.replace('."'".'../verify.php?f=log'."'".')">Sou membro</button>';
                    }
                ?>
            </nav>
        </div>
    </header>

    <!------------------------------------------- MAIN ------------------------------------------->
    <main>
        <!-- ASIDE -->
        <aside id="aside">
            <ul>
                <a href="home.php"><li><i class="fa-solid fa-house"></i> Home</li></a>
                <a href="articles.php"><li><i class="fa-solid fa-book"></i> Artigos</li></a>
                <a href="events.php"><li><i class="fa-solid fa-calendar"></i> Eventos</li></a>
                <a href="contact.php"><li><i class="fa-solid fa-handshake"></i> Seja NEABI</li></a>
            </ul>

            <?php
            if (isset($_SESSION['user']) and ($_SESSION['user']['position'] == "coordenador" or $_SESSION['user']['position'] == "administrador")) {
                echo '
                <hr>
                <ul>
                    <a href="mod.php"><li><i class="fa-solid fa-handshake"></i> Coordenação</li></a>
                </ul>
                ';
            };
            if (isset($_SESSION['user']) and $_SESSION['user']['position'] == "administrador") {
                echo '
                <hr>
                <ul>
                    <a href="adm.php"><li><i class="fa-solid fa-house"></i> ADM hub</li></a>
                </ul>
                ';
                
            };
            ?>
        </aside>
        <!------------------------------------------- CONTENT ------------------------------------------->
        <section class="content">
            <div class="container-fluid">
                <br><br>
                <hgroup>
                    <h2>ADM Hub</h2>
                    <p>Central de controle de administradores</p>
                    <hr>
                    <br>
                    <h5>Você esta logado como:</h5>
                    <h6>Nome:<?php echo $_SESSION['user']['username']; ?></h6>
                    <h6>ID:<?php echo $_SESSION['user']['id']; ?></h6>
                    <h6>Cargo:<?php echo $_SESSION['user']['position']; ?></h6>
                    <h6>Grupo:<?php echo $_SESSION['user']['team']; ?></h6>
                </hgroup>
            </div>
            <br>
            <hr>
            <br>
            <!-- administrar/criar chaves de criação de usuarios -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <hgroup>
                        <h3>Administração de Chaves</h3>
                        <p>Adicione ou remova chaves de criação de usuarios</p>
                    </hgroup>
                    <br>
                    <div class="card">
                        <form action="adm.php?action=criar_chave" method="post">
                            <header>
                                <h4>Adicionar chave</h4>
                            </header>
                            <label for="team">Grupo:</label>
                            <select name="team" id="team" required>
                            <?php
                                require '../PHP/db.php';
                                $sql = "SELECT * FROM teams WHERE is_active = 1";
                                $result = $pdo->query($sql);
                                if ($result->rowCount() > 0) {
                                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['id'].'">'.$row['team_name'].'</option>';
                                    }
                                } else {
                                    echo "<option value=''>Nenhum grupo encontrado</option>";
                                }
                            ?>
                            </select>
                            <br>
                            <label for="position">Cargo:</label>
                            <select name="position" id="position" required>
                                <option value="escritor">Escritor</option>
                                <option value="coordenador">Coordenador</option>
                                <option value="administrador">Administrador</option>
                            </select>
                            <footer>
                                <button type="submit">Criar chave</button>
                            </footer>
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'criar_chave') {
                                    $team_id = $_POST['team'];
                                    $position = $_POST['position'];
                                    $created_by_user_id = $_SESSION['user']['id'];
                                    $creation_key = sha1(random_bytes(20));
                                    
                                    $sql = "INSERT INTO creation_keys (creation_key, team_id, position, created_by_user_id) VALUES (?, ?, ?, ?)";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute([$creation_key, $team_id, $position, $created_by_user_id]);
                                    
                                    echo "<script>alert('Chave criada com sucesso! A chave é: ".$creation_key."');</script>";
                                }
                            ?>
                        </form>
                    </div>
                    <br>
                    <div class="card">
                        <form action="adm.php" method="post">
                            <header>
                                <h4>Remover chave</h4>
                            </header>
                            <label for="key">Chave:</label>
                            <h6>(para: Posição | para: grupo | chave | data de criação | criado por:)</h6>
                            <select name="key" id="key">
                            <?php
                                require '../PHP/db.php';
                                $sql = "SELECT k.creation_key, t.team_name, k.position, k.creation, u.username  
                                            FROM creation_keys k 
                                        inner join users u on u.id = k.created_by_user_id 
                                        inner join teams t on t.id = k.team_id
                                        where used = 0";
                                $result = $pdo->query($sql);
                                if ($result->rowCount() > 0) {
                                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['creation_key'].'">'.$row['position'].' | '.$row['team_name'].' | '.$row['creation_key'].' | '.$row['creation'].' | '.$row['username'].'</option>';
                                    }
                                } else {
                                    echo "<option value=''>Nenhuma chave encontrada</option>";
                                }
                            ?>
                            </select>
                            <br>
                            <footer>
                                <button type="submit">Remover chave</button>
                            </footer>
                        </form>
                    </div>
                </div>
            
            <!-- area de administração (criar/desativar grupos)-->
            <div class="container-fluid">
                <hgroup>
                    <h3>Administração de Grupos</h3>
                    <p>Adicione ou remova grupos</p>
                </hgroup>
                <br>
                <div class="card">
                    <form action="adm.php" method="post">
                        <header>
                            <h4>Adicionar grupo</h4>
                        </header>
                        <label for="team">Nome do grupo:</label>
                        <input type="text" name="team" id="team" required>
                        <footer>
                            <button type="submit">Criar grupo</button>
                        </footer>
                    </form>
                </div>
                <br>
                <div class="card">
                    <form action="adm.php" method="post">
                        <header>
                            <h4>Remover grupo</h4>
                        </header>
                        <label for="team">Nome do grupo:</label>
                        <select name="team" id="team">
                        <?php
                            require '../PHP/db.php';
                            $sql = "SELECT * FROM teams where is_active = 1";
                            $result = $pdo->query($sql);
                            if ($result->rowCount() > 0) {
                                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="'.$row['team_name'].'">'.$row['team_name'].'</option>';
                                }
                            } else {
                                echo "<option value=''>Nenhum grupo encontrado</option>";
                            }
                        ?>
                        </select>
                        <br>
                        <footer>
                            <button type="submit">Remover grupo</button>
                        </footer>
                    </form>
            </div>
            <br>
            <hr>
            <br>
            <div class="container-fluid">
                <hgroup>
                    <h3>Administração de Usuarios</h3>
                    <p>Desative, modifique ou veja estatisticas de usuarios</p>
                </hgroup>
                <br>
                <div class="card">
                    <form method="post">
                        <header>
                            <h4>Gerenciar usuario</h4>
                        </header>
                        <label for="user">Nome do usuario:</label>
                        <select name="user" id="user">
                        <?php
                            require '../PHP/db.php';
                            $sql = "SELECT * FROM users where is_active = 1";
                            $result = $pdo->query($sql);
                            if ($result->rowCount() > 0) {
                                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
                                }
                            } else {
                                echo "<option value=''>Nenhum usuario encontrado</option>";
                            }
                        ?>
                        </select>
                        <br>
                        <footer>
                            <button type="submit" formaction="desativar_usuario.php">Desativar usuario</button>
                            <button type="submit" formaction="modificar_usuario.php">Modificar usuario</button>
                            <button type="submit" formaction="ver_estatisticas_usuario.php">Ver estatisticas</button>
                        </footer>
                    </form>
                </div>
                <br>
                <div class="card">
                    <form method="post">
                        <header>
                            <h4>Reativar usuario</h4>
                        </header>
                        <label for="user">Nome do usuario:</label>
                        <select name="user" id="user">
                        <?php
                            require '../PHP/db.php';
                            $sql = "SELECT * FROM users where is_active = 0";
                            $result = $pdo->query($sql);
                            if ($result->rowCount() > 0) {
                                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
                                }
                            } else {
                                echo "<option value=''>Nenhum usuario encontrado</option>";
                            }
                            $pdo = null; // Close the database connection
                        ?>
                        </select>
                        <br>
                        <footer>
                            <button type="submit" formaction="reativar_usuario.php">Reativar usuario</button>
                        </footer>
                    </form>
                </div>
            </div>
                <!-- administração de articles[desativar, ativar, modificar] -->
                <br>
                <hr>
                <br>
                <div class="container-fluid">
                    <hgroup>
                        <h3>Administração de Artigos</h3>
                        <p>Desative, modifique ou veja estatisticas de artigos</p>
                    </hgroup>
                    <br>
                    <div class="card">
                        <form method="post">
                            <header>
                                <h4>Gerenciar artigo</h4>
                            </header>
                            <label for="article">Titulo do artigo:</label>
                            <select name="article" id="article">
                            <?php
                                require '../PHP/db.php';
                                $sql = "SELECT * FROM articles where is_active = 1";
                                $result = $pdo->query($sql);
                                if ($result->rowCount() > 0) {
                                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
                                    }
                                } else {
                                    echo "<option value=''>Nenhum artigo encontrado</option>";
                                }
                            ?>
                            </select>
                            <br>
                            <footer>
                                <button type="submit" formaction="desativar_artigo.php">Desativar artigo</button>
                                <button type="submit" formaction="modificar_artigo.php">Modificar artigo</button>
                                <button type="submit" formaction="ver_estatisticas_artigo.php">Ver estatisticas</button>
                            </footer>
                        </form>
                    </div>
                    <br>
                    <div class="card">
                        <form method="post">
                            <header>
                                <h4>Reativar artigo</h4>
                            </header>
                            <label for="article">Titulo do artigo:</label>
                            <select name="article" id="article">
                            <?php
                                require '../PHP/db.php';
                                $sql = "SELECT * FROM articles where is_active = 0";
                                $result = $pdo->query($sql);
                                if ($result->rowCount() > 0) {
                                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
                                    }
                                } else {
                                    echo "<option value=''>Nenhum artigo encontrado</option>";
                                }
                                $pdo = null; // Close the database connection
                            ?>
                            </select>
                            <br>
                            <footer>
                                <button type="submit" formaction="reativar_artigo.php">Reativar artigo</button>
                            </footer>
                        </form>
                    </div>
                    <br>

        </section>
    </main>

    <!------------------------------------------- FOOTER ------------------------------------------->
    <footer>
        <div class="container-fluid">
            <hgroup>
                <h6><i class="fa-solid fa-flask"></i> Criado e dirigido por alunos do IFSULDEMINAS-MUZAMBINHO</h6>
            </hgroup>
        </div>
    </footer>

        <!------------------------------------------- MODAL ------------------------------------------->
        <dialog id='modal' class="container-fluid centered-col">
        <article>
            <header>
                <button aria-label="Close" rel="prev" onclick="modal.style.display='none'"></button>
                <p>
                    <strong>Aviso!</strong>
                </p>
            </header>
            <p>
            <?php
            echo "".$_GET['r']."";
            ?>
            </p>
        </article>
    </dialog>

    <!-- JS FOR THEME CHANGE -->
    <script>
        const icon = document.getElementById("theme-icon");
        const logo = document.getElementById("logo");
        const logo_mp = document.getElementById("logo-mp")
        const html = document.getElementById('htmltag');

        (function(){
            if (localStorage.getItem('theme') == null){
                localStorage.setItem('theme', 'light');
            }
            html.setAttribute('data-theme', localStorage.getItem('theme'));
            if (localStorage.getItem('theme') === 'dark'){
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_WHITE.png');
                logo_mp.setAttribute('src','../ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_DARK.png');
                logo_mp.setAttribute('src','../ASSETS/NEABI_LOGO_DARK.png');
            }
        })();

        function darkMode () {
            var targetTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

            if (targetTheme === 'dark'){
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_WHITE.png');
                logo_mp.setAttribute('src','../ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_DARK.png');
                logo_mp.setAttribute('src','../ASSETS/NEABI_LOGO_DARK.png');
            }
            }

            // modal opening when return message is set
            modal = document.getElementById('modal');

            if (r != ''){
            modal.style.display='flex'
            }
    </script>
</body>
</html>
