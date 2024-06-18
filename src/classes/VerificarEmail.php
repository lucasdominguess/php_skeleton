<?php
namespace App\classes;
use voku\helper\AntiXSS;


class VerificarEmail 
{

    public function __construct(string $email)
    {
        $this->ver_email($email);
    }

    public function ver_email($email)
    {   
        $xss = new AntiXSS();
        $email2 = $xss->xss_clean($_POST['email']); 

        if (!preg_match("/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im", $email2)) {   //Regex para validar formado de nome com min. de 3
            $response=['status' => 'fail', 'msg' => 'Email Inválido!'];
            return $response;
          
        }
        // return $email2 ;
    }
}
