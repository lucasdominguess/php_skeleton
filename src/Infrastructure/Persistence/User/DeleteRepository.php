<?php
namespace App\Infrastructure\Persistence\User;



class DeleteRepository 
{

    public function __construct(public Sql $db)
    {
        
    }


    public function deleteAll($table)
    {
        $stmt = $this->db->prepare("delete * from :table");
        $stmt->bindValue(":table", $table);
        $stmt->execute();
    
        
       
    }
    public function Delete_EstagiariosOfId($id)
    {
        $stmt =$this->db->prepare("delete from estagiarios where id = :id");
  
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        
        
      
    }
    public function Delete_AdminsOfId($id)
    {
        $stmt =$this->db->prepare("delete from usuarios where id = :id");
  
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        
        
      
    }
    public function Delete_TentativasOfId($id)
    {
        $stmt =$this->db->prepare("delete from tentativas where id = :id");
  
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        
        
      
    }
}