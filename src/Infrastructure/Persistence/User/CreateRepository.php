<?php
namespace App\Infrastructure\Persistence\User;

use App\Infrastructure\Helpers;
use Exception;
use InvalidArgumentException;



class CreateRepository 
{

    public function __construct(public Sql $db)
    {
        
    }

    public function createUser($cad,$primarykey,$id_adm){
        $stmt=$this->db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data");
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
    // public function createArquivos($id, $id_user, $create_time, $name, $type, $temp_name, $error, $size){
    //     $stmt=$this->db->prepare("insert into arquivos(id,id_user,create_time,name,type,temp_name,error,size) values(:id,:id_user:,:create_time,:name,:type,:temp_name,:error,:size)");
    //     $params = [
    //         ':id' => $id,
    //         ':id_user' => $id_user,
    //         ':create_time' => $create_time,
    //         ':name' => $name,
    //         ':type' => $type,
    //         ':temp_name' => $temp_name,
    //         ':error' => $error,
    //         ':size' => $size
    //     ];
    //     $this->db->setParms($stmt,$params);
    //     $stmt->execute();
    // }

    public function createArquivos2(array $data) {
        // Verificar se o array de dados não está vazio
        if (empty($data)) {
            throw new InvalidArgumentException("Os dados não podem estar vazios");
        }
    
        // Obter os nomes das colunas a partir das chaves do array
        $columns = array_keys($data);
    
        // Criar os placeholders correspondentes
        $placeholders = array_map(fn($col) => ':' . $col, $columns);
        
        // Helpers::dd($columns);
        // Helpers::dd($placeholders);

        // Construir a consulta SQL
        $query = sprintf(
            "INSERT INTO arquivos (%s) VALUES (%s)",
            implode(', ', $columns),
            implode(', ', $placeholders)
        );
        // Helpers::dd($query);

        // Preparar a declaração
        $stmt = $this->db->prepare($query);
    
        // Vincular os valores do array de dados
        foreach ($data as $column => $value) {
            $stmt->bindValue(':' . $column, $value);
        }
    
        // Executar a declaração
        $stmt->execute();
    }
public function createArquivos(array $data) {
        // Verificar se o array de dados não está vazio
        if (empty($data)) {
            throw new InvalidArgumentException("Os dados não podem estar vazios");
        }
    
        // Obter os nomes das colunas a partir das chaves do array
        $columns = array_keys($data);
        
        // Construir a consulta SQL para inserir uma linha
        $query = sprintf(
            "INSERT INTO arquivos (%s) VALUES (%s)",
            implode(', ', $columns),
            implode(', ', array_map(fn($col) => ':' . $col, $columns))
        );
    
        // Preparar a declaração
        $stmt = $this->db->prepare($query);
    
        // Obter o número de registros
        $numRecords = count($data['name']);  // Usamos 'name' como referência para o número de registros
    
        // Iterar sobre cada registro e executar a inserção
        for ($i = 0; $i < $numRecords; $i++) {
            // Vincular os valores do array de dados para o registro atual
            foreach ($data as $column => $values) {
                $stmt->bindValue(':' . $column, $values[$i]);
            }
    
            // Executar a declaração
            try {
                
                $stmt->execute();
            } catch (\PDOException $th) {
                // $th = ['']
                 
                 return $th;
            }
        }
    }

public function createTest(array $data) {
        // Verificar se o array de dados não está vazio
        if (empty($data)) {
            throw new InvalidArgumentException("Os dados não podem estar vazios");
        }
    
        // Obter os nomes das colunas a partir das chaves do array
        $columns = array_keys($data);
        
        // Construir a consulta SQL para inserir uma linha
        $query = sprintf(
            "INSERT INTO teste (%s) VALUES (%s)",
            implode(', ', $columns),
            implode(', ', array_map(fn($col) => ':' . $col, $columns))
        );
    
        // Preparar a declaração
        $stmt = $this->db->prepare($query);
    
        // Obter o número de registros
        $numRecords = count($data);  // Usamos 'name' como referência para o número de registros
    
        // Iterar sobre cada registro e executar a inserção
        for ($i = 0; $i < $numRecords; $i++) {
            // Vincular os valores do array de dados para o registro atual
            foreach ($data as $column => $values) {
                $stmt->bindValue(':' . $column, $values[$i]);
            }
    
            // Executar a declaração
            try {
                
                $stmt->execute();
            } catch (\PDOException $th) {
                // $th = ['']
                 
                 return $th;
            }
        }
    }
    
}
    
