<?php
// session_start();
// if ($_SESSION["email"] == null) {
//     header('location: http://localhost:9000');
// }
// $nome = $_SESSION['nome'] ?? '';

// $nome = $_SESSION['nome'] ?? '';
// $logado = $_SESSION['sessao'] ?? 'ffff';
// $logado2 = $_SESSION['sessao']->format('H:i:s');
// // $tempo = $_SESSION['tempo30'] ?? 'vazio' ;
// // $newtime = $tempo->format("H:i:s");



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.2/af-2.7.0/b-3.0.1/b-html5-3.0.1/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/rr-1.5.0/sb-1.7.0/sl-2.0.0/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registrar.css">
    <title>Cadastro</title>
</head>

<body class="body_bg">

    <section id="conteudo">

        <header id="header">

            <section id="sessao_adm" class="col-2">
                <div id="nomeAdm">
                    <div>
                        <h4>Bem-vindo</h4>
                        <h3><?php echo $nome; ?> ! </h3>
                    </div>
                </div>
                <div id="tempo_sessao">
                    <?php echo $logado2;   ?> <br>
                </div>
                <div>
                    <button class="btn btn-danger">Sair</button>
                </div>

            </section>

            <section id="nav" class='col-sm-8'>
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                                </li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>
                </div>

            </section>
        </header>
        <!-- Sessao cadastro -->
        <section id="sessao_cadastro">
        </section>

        <!-- Sessao tabela -->
        <section id="sessao_tabela" class="container col-sm-8">

            <div id="div_btncad">
                <button id="btn_cadastrar" class="btn btn-primary" type="button">Cadastrar</button>

            </div>

        </section>

    </section>

    <!-- Sessao modal  -->
    <section id="sessao_modal">

        <div class="modal bg-transp" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">


                    <div class="modal-header">
                        <!-- <h4 class="modal-title">Insira os novos dados de edição</h4> -->
                        <button id="btn_close" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>


                    <div class="modal-body">

                        <form id="form_cad" class="">


                            <h3 id="title_h3">Cadastro</h3>
                            <input type="hidden" name="id" id="id"  class="form-control">
                            <label for="nome" class="form-label"><b>Nome:</b></label><br>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome aqui!"  class="form-control"><br><br>
                            <label for="data_nascimento" class="form-label"><b>Data de Nascimento:</b></label><br>
                            <input type="date" id="data" name="data_nascimento"  class="form-control"><br><br>


                        </form>
                    </div>

                    <div class="modal-footer">
                        <button id="fechar" type="button" class="btn btn-danger">Fechar</button>
                        <button id="btn_enviarCad" type="button" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </div>


    </section>


</body>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/rr-1.5.0/sb-1.7.0/sl-2.0.0/datatables.min.js"></script>

<script src="assets/js/listar_dados.js"></script>
<script src="assets/js/editar_dados.js"></script>
<script src="assets/js/enviar_dados.js"></script>
<script src="assets/js/logar.js"></script>
<script src="assets/js/index.js" ></script>

</html>