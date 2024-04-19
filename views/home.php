{% extends "base.html" %}
{% block link %}


        <html id='html_admhome'>
        <link rel="stylesheet" href="/assets/css/home.css">    
        <title>Cadastro</title>
{% endblock %}

    
{% block body %}
{% set username = constant('USERNAME') %}
{% set useremail = constant('USEREMAIL') %}
{% set userid = constant('USERID') %}
{% set userdata = constant('USER_DATA') %}

<section id="conteudo">

    <header id="header">
        {{include('dados_session.html')}}
        {{include('nav.html')}}

    </header>
    
    {{include('tabela.html')}}



    {{include('sessao_modal_cadastro.html')}}

</section>

{% endblock %}

{% block script %}
<script src="/assets/js/listar_dados.js"></script>
{% endblock %}