{% extends 'base.html' %}

{% block link %}

<html id="html_login" lang="pt-br" class="htmlpags">
<link rel="stylesheet" href="assets/css/login.css">
<title>login</title>
{% endblock %}

{% block body %}
<body class="">

    <section id="divicon">

     
    </section>
    <!-- Sessao login -->
    <section id="sessao" class="container-fluid">

        <!-- <div id="div-img"> <img id="img" class="opacity-50" src="assets/img/img2.svg" alt="">
            </div> -->
        <div id="login">

            <form id="form_login">
                <div class="div_form">
                    <div>

                        <div class="conteudo">
                            <div id="div_icons">
                                <abbr title="Modo Dark"><i id="icon_login" class="fa-solid fa-moon icons"></i>
                                </abbr>
                                <!-- <p>Modo Dark</p> -->
                            </div>
                            <div id="div_h3login">
                                <h3 id="title_login">Login</h3>
                            </div>
                            <input type="hidden" name="id" id="id">

                            <label for="email"><b>Email:</b></label><br>
                            <input class="input" type="email" id="email" name="email" placeholder="exemplo@prefeitura.sp.gov"><br><br>
                            <input type="hidden" name="{{csrf.keys.name}}" value="{{csrf.name}}">
                            <input type="hidden" name="{{csrf.keys.value}}" value="{{csrf.value}}">
                            <label for="senha"><b>Senha:</b></label><br>
                            <input class="input" type="password" id="senha" name="senha" placeholder="Digite sua senha "><br><br>

                            <button id="btn_entrar" class="btn_entrar" type="button">Entrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
{% endblock %}


{% block script %}
{% endblock %}
