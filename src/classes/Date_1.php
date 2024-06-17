<?php 


$d = Date('now',);
$d = new \DateTimeZone('America/Sao_Paulo');
$d = new DateTime('now');
$d->add(date_interval_create_from_date_string("+ 10 minutes")); 
$d->getTimestamp();  
$d->format('Y-m-d H:i:s'); 
$d->diff($d);



print_r($d);