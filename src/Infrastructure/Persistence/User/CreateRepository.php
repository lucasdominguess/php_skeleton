<?php
namespace App\Infrastructure\Persistence\User;



class CreateRepository 
{

    public function __construct(public Sql $db)
    {
        
    }

    public function create($cad,$primarykey,$id_adm){
        $stmt=$this->db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data");
        $var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }
}