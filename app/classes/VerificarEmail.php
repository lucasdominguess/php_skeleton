<?php
require_once 'Sql.php';

class VerificarEmail
{

    public function __construct(string $email)
    {
        $this->ver_email($email);
    }

    public function ver_email($email)
    {
        if (empty($email)) {   //Regex para validar formado de nome com min. de 3
            echo json_encode(['status' => 'fail', 'msg' => 'O Email não pode estar em branco']);
            exit();
        }
        if (!preg_match("/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im", $email)) {   //Regex para validar formado de nome com min. de 3
            echo json_encode(['status' => 'fail', 'msg' => 'Email Inválido!']);
            exit();
        }
    }
}
