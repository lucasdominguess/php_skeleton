<?php

use App\Domain\User\User;
 
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
ini_set('default_charset', 'UTF-8');
 
$GLOBALS['TZ'] = new \DateTimeZone( 'America/Sao_Paulo');
$GLOBALS['datefull'] = (new DateTime('now', $GLOBALS['TZ']))->format('d/m/Y H:i:s');
$GLOBALS['hours'] = (new DateTime('now',$GLOBALS['TZ']))->format('H:i:s');

$id_adm = $_SESSION[User::USER_ID] ?? null ;
define('USERID',$id_adm);
$nome = $_SESSION[User::USER_NAME] ?? '' ; 
define('USERNAME',$nome);

$email = $_SESSION[User::USER_EMAIL] ?? '' ; 
define('USEREMAIL',$email );

define('USER_DATA', $GLOBALS['hours']);

define('URL_HOMEUSER','http://localhost:9000/user/acessouser');

define('URL_HOMEADM','http://localhost:9000/admin/acessoadm');


define('URL_EXIBIR_ADMIN','http://localhost:9000/admin/exibiradmins');
define('URL_TENTA_ACESSO','http://localhost:9000/admin/tentativasacesso');

// @define('USERNAME',$_SESSION[ User::USER_NAME] );
// @define('USEREMAIL',$_SESSION[ User::USER_EMAIL] );
// define('USERSESSION',$_SESSION[ User::USER_DATE] );