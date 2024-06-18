<?php 
namespace App\classes;

use PDO;
use DateTime;
use DateTimeZone;
use App\classes\BloquearAcesso;

use App\Application\Actions\User\controlers;
use App\Infrastructure\Persistence\User\Sql;
use App\Application\Actions\User\controlers\LogarAction;

class ConsultaBanco{ 
   
    public function __construct(public string $email,public string $senha)
    {   
        $this->verificarLogin($email,$senha); 
        
    }

    protected function verificarLogin($email,$senha) {
        $dbs =new Sql();
                  
        $stmt = $dbs->prepare("SELECT COUNT(*) AS total FROM tentativa WHERE emails = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['total'];
    
        if ($count >= 3) { 
            
            $block = new BloquearAcesso();
            $block->bloqueio($email,$senha);
            
        }
    }

}

