<?php 
namespace App\Infrastructure\Persistence\User;


abstract class InsertRepository{
   
    static public function insert($db,$cad,$primarykey,$id_adm,$table){
        $stmt=$db->prepare("insert into $table (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm)");
        $var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
        $db->setParms($stmt,$var);
        $stmt->execute();
    }
 
}