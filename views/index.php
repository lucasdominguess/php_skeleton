<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.2/af-2.7.0/b-3.0.1/b-html5-3.0.1/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/rr-1.5.0/sb-1.7.0/sl-2.0.0/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    
    <title>login</title>
</head>

<body class="body_bg">
        
    <!-- Sessao cadastro -->
    <section id="sessao_login" class="">
            <!-- <div id="div-img"> <img id="img" class="opacity-50" src="img.svg" alt="">
            </div> -->
            <div class="" id="login">

            <form id="form_login">
                <div class="modal-content">
                    <div>
            
                        <div class="conteudo">
   
                            <div id="h3login">
                                <h3 id="title_login">Login</h3> 
                            </div> 
                            <input type="hidden" name="id" id="id">

                            <label for="email"><b>Email:</b></label><br>
                            <input class="input" type="email" id="email" name="email" placeholder="exemplo@prefeitura.sp.gov"><br><br>

                            <label for="senha"><b>Senha:</b></label><br>
                            <input class="input"  type="password" id="senha" name="senha" placeholder="Digite sua senha "><br><br>

                            <button id="btn_entrar" class="btn_entrar" type="button">Entrar</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </section>
</body>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.2/af-2.7.0/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/rr-1.5.0/sb-1.7.0/sl-2.0.0/datatables.min.js"></script>

<script src=""></script>
<script src="assets/js/listar_dados.js"></script>
<script src="assets/js/editar_dados.js"></script>
<script src="assets/js/enviar_dados.js"></script>
<script src="assets/js/logar.js"></script>

<script src="assets/js/index.js" ></script>
</html>