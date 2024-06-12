<?php 
namespace App\Infrastructure\Persistence\User;


 class UpdateRepository 
{ 
    public function updateById($table,$id,$db)
    { 
        
    }
    public function update($db,$email,$value)
    { 
        $stmt=$db->prepare("UPDATE usuarios SET nivel = :value where email = :email ");
        $var=[':email'=>$email,':value'=> $value];
        $db->setParms($stmt,$var);
        $stmt->execute();
    }
}