<?php
namespace App\Infrastructure\Persistence\User;

 
class DeleteRepository{
 
   
    static public function deleteAll($db,$table)
    {
        $stmt = $db->prepare("delete * from :table");
        $stmt->execute();
    }
    static public function deleteId($db,$table,$id){
        // $stmt =$db->prepare("delete from estagiarios where id = :id");
        $stmt =$db->prepare("delete from $table where id = :id");
        $stmt->bindValue(":id",$id);
        // $stmt->bindValue(":table",$table);
        $stmt->execute();
       
    }
}