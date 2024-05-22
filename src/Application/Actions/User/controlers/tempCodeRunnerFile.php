<?php
if (!isset($retorno[0]['id_adm']) || !password_verify($senha, $retorno[0]['senha'])) {