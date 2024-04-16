{% extends 'base.html' %}

{% block php %}

{% endblock %}



{% block link %}
<html id='html_home' class="htmlpags">
<link rel="stylesheet" href="assets/css/home.css">
<title>Cadastro</title>
{% endblock %}







{% block body %}

<body class="body_dark">

    <section id="conteudo">

        <header id="header">

            <section id="sessao_adm" class="col-2">
                <div id="nomeAdm">
                    <div>
                        <h4 class="escletra h1s">Bem-vindo !</h4>
                        <h3><?php echo $nome; ?> </h3>
                    </div>
                </div>
                <div id="tempo_sessao">
                    <?php echo $tempo  ?> <br>
                </div>
                <div>
                    <button id="btn_sair" class="btn btn-danger">Sair</button>
                </div>

            </section>

            <section id="nav" class='col-sm-8'>
                <nav class="navbar navbar-expand-lg ">
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
                    <div id="div_icons">
                        <abbr title="Modo Dark"><i id="icon_home" class="fa-solid fa-moon icons"></i>
                        </abbr>

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
                            <input type="hidden" name="id" id="id" class="form-control">
                            <label for="nome" class="form-label"><b>Nome:</b></label><br>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome aqui!" class="form-control"><br><br>
                            <label for="data_nascimento" class="form-label"><b>Data de Nascimento:</b></label><br>
                            <input type="date" id="data" name="data_nascimento" class="form-control"><br><br>

                            <label id="label-cep" for="cep" class="">Cep:</label><br>
                            <input type="text" id="cep" name="cep" placeholder="Digite seu cep" class="form-control"><br><br>

                            <label id="label-NomeRua" for="nome_rua" class="">nome da rua</label><br>
                            <input type="text" id="nome_rua" name="nome_rua" readonly class="form-control"><br><br>

                            <label id="label-NumeroC" for="numero_casa" class="">numero da casa:</label><br>
                            <input type="text" id="numero_casa" name="numero_casa" class="form-control"><br><br>

                            <label id="label-bairro" for="bairro" class="">Bairro:</label><br>
                            <input type="text" id="bairro" name="bairro" readonly class="form-control"><br><br>

                            <label id="label-uf" for="uf" class="">Uf:</label><br>
                            <input type="text" id="uf" name="uf" readonly class="form-control"><br><br>

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


    {% endblock %}



    {% block script %}
    <script src="assets/js/listar_dados.js"></script>
    {% endblock %}