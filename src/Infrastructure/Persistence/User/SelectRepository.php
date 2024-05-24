<?php 
namespace App\Infrastructure\Persistence\User;

abstract class SelectRepository{ 

    static public function selectAll($table,$db)
    { 
        $stmt = $db->prepare("select * from $table");
       
        $stmt->execute();
        $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
    static public function selectById($table,$id,$db){ 
        $stmt =$db->prepare("select * from $table where id = :id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
}