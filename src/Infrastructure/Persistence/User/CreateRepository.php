<?php
namespace App\Infrastructure\Persistence\User;


use InvalidArgumentException;



class CreateRepository 
{

    public function __construct(public Sql $db)
    {
        
    }

    public function createUser($cad,$primarykey,$id_adm){
        $stmt=$this->db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data,id=:id");
        $var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }

    public function createAdmin($nome,$email,$senha,$nivel){ 
        $stmt=$this->db->prepare("insert into usuarios (nome,email,senha,nivel) values(:nome,:email,:senha,:nivel) on duplicate key update nome=:nome,email=:email,senha=:senha,nivel=:nivel");
        $var=[':nome'=>(trim($nome)),':email'=>$email,':senha'=>$senha,':nivel'=>$nivel];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }

    public function createResetSenha($date,$email,$token) { 
        $stmt=$this->db->prepare("insert into reset(date,email,token) values(:date,:email,:token)");
        $var=[':date'=>$date,':email'=>$email,':token'=>$token];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }
    public function updateSenha($email,$value){ 
        $stmt=$this->db->prepare("UPDATE usuarios SET senha = :value where email = :email ");
        $var=[':email'=>$email,':value' => $value];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }
 


public function createArquivos(array $data) {
        if (empty($data)) {
            throw new InvalidArgumentException("Os dados não podem estar vazios");
        }
    
        $columns = array_keys($data);
        
      
        $query = sprintf(
            "INSERT INTO arquivos (%s) VALUES (%s)",
            implode(', ', $columns),
            implode(', ', array_map(fn($col) => ':' . $col, $columns))
        );
    
        $stmt = $this->db->prepare($query);
          
        $numRecords = count($data['name']); 
    
   
        for ($i = 0; $i < $numRecords; $i++) {
          
            foreach ($data as $column => $values) {
                $stmt->bindValue(':' . $column, $values[$i]);
            }
    
        
            try {
                
                $stmt->execute();
            } catch (\PDOException $th) {
             
                 
                 return $th;
            }
        }
    }
}
