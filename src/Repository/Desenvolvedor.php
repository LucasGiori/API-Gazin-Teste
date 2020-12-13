<?php 

declare(strict_types=1);

namespace App\Repository;

use App\Database\Exception\PrimaryKeyViolated;
use PDO;
use Exception;
use App\Entity\Desenvolvedor as DesenvolvedorEntity;
use App\Database\Exception\SintaxeErrorException;
use App\Database\Exception\TabelaInexistenteException;
use App\InterfaceRepository\InterfaceDesenvolvedorRepository;
use App\Handler\BaseHandler;

final class Desenvolvedor extends BaseHandler implements InterfaceDesenvolvedorRepository
{
    protected PDO $dbh;

    public function __construct(PDO $connection)
    {
        $this->dbh = $connection;
    }

    public function getAll():array
    {
        try{            
            $sql = "SELECT
                        d.id
                        ,d.nome
                        ,d.sexo
                        ,d.idade
                        ,d.hobby
                        ,d.datanascimento
                    FROM desenvolvedor d";
            
            $stmt = $this->dbh->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, DesenvolvedorEntity::class);    
            $stmt->execute();              
            return $stmt->fetchAll();
        }catch(SintaxeErrorException $e){
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            throw new Exception('Tabela Inexistente');
        }catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage());
        }

    }

    public function getByPagination(int $limit, int $offset):array
    {
        try{  
            $sql = "SELECT
                        d.id
                        ,d.nome
                        ,d.sexo
                        ,d.idade
                        ,d.hobby
                        ,d.datanascimento
                    FROM desenvolvedor d LIMIT :limit OFFSET :offset;
            ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);   
            $stmt->bindParam(':limit',$limit);
            $stmt->bindParam(':offset',$offset);
            $stmt->execute();
            return $stmt->fetchAll(); 
        }catch(SintaxeErrorException $e){
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            throw new Exception('Tabela Inexistente');
        }catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage());
        }
    }

    public function getById(int $id): DesenvolvedorEntity
    {
        try{            
            $sql = "SELECT
                        d.id
                        ,d.nome
                        ,d.sexo
                        ,d.idade
                        ,d.hobby
                        ,d.datanascimento
                    FROM desenvolvedor d
                    WHERE d.id = :id ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, DesenvolvedorEntity::class);
            $stmt->bindParam(':id',$id);         
            $stmt->execute();     
            $desenvolvedor = $stmt->fetch();
            if(!$desenvolvedor){
                throw new Exception('Não existe nenhum desenvolvedor com esta identificação cadastrada!');
            }
            return $desenvolvedor;            

        }catch(SintaxeErrorException $e){
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            throw new Exception('Tabela Inexistente');
        }catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage());
        }
    }

    public function save(DesenvolvedorEntity $desenvolvedor):void
    {   
        
        try{
            $this->dbh->beginTransaction();
            $sql = "INSERT INTO desenvolvedor (nome,sexo,idade,hobby,datanascimento) VALUES (:nome,:sexo,:idade,:hobby,:datanascimento); ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':nome',$desenvolvedor->nome);
            $stmt->bindParam(':sexo',$desenvolvedor->sexo);
            $stmt->bindParam(':idade',$desenvolvedor->idade);
            $stmt->bindParam(':hobby',$desenvolvedor->hobby);
            $stmt->bindParam(':datanascimento',$desenvolvedor->datanascimento);
            $stmt->execute();   
            $this->dbh->commit();
        }catch(PrimaryKeyViolated $e){
            $this->dbh->rollBack(); 
            throw new Exception('Já existe um desenvolvedor com este nome cadastrado!');
        }catch(SintaxeErrorException $e){
            $this->dbh->rollBack(); 
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            $this->dbh->rollBack(); 
            throw new Exception('Tabela inexistente');
        }catch(Exception $e){
            $this->dbh->rollBack(); 
            throw new Exception("Error: ".$e->getMessage());
        }
    }

    public function update(int $id,DesenvolvedorEntity $desenvolvedor):void
    {
        try{
            $this->dbh->beginTransaction();
            $sql = "UPDATE desenvolvedor 
                    SET nome = :nome
                        ,sexo = :sexo
                        ,idade = :idade
                        ,hobby = :hobby
                        ,datanascimento = :datanascimento 
                    WHERE id = :id;";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':nome',$desenvolvedor->nome);
            $stmt->bindParam(':sexo',$desenvolvedor->sexo);
            $stmt->bindParam(':idade',$desenvolvedor->idade);
            $stmt->bindParam(':hobby',$desenvolvedor->hobby);
            $stmt->bindParam(':datanascimento',$desenvolvedor->datanascimento);
            $stmt->bindParam(':id',$id);
            $stmt->execute();   
            $this->dbh->commit();
        }catch(SintaxeErrorException $e){
            $this->dbh->rollBack(); 
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            $this->dbh->rollBack(); 
            throw new Exception('Tabela inexistente');
        }catch(Exception $e){
            $this->dbh->rollBack(); 
            throw new Exception("Error: ".$e->getMessage());
        }
    }

    public function delete(int $id):void
    {
        try{
            $this->dbh->beginTransaction();
            $sql = "DELETE FROM desenvolvedor WHERE id = :id;";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();   
            $this->dbh->commit();
        }catch(SintaxeErrorException $e){
            $this->dbh->rollBack(); 
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            $this->dbh->rollBack(); 
            throw new Exception('Tabela inexistente');
        }catch(Exception $e){
            $this->dbh->rollBack(); 
            throw new Exception("Error: ".$e->getMessage());
        }
    }
    public function count():int
    {
        try{            
            $sql = "SELECT
                        count(d.id)
                    FROM desenvolvedor d";
            $stmt = $this->dbh->prepare($sql);       
            $stmt->execute();    
            $desenvolvedor = (int)($stmt->fetch()['count'] ?? 0);
            return $desenvolvedor;            

        }catch(SintaxeErrorException $e){
            throw new Exception('Query mal escrita!');
        }catch(TabelaInexistenteException $e){
            throw new Exception('Tabela Inexistente');
        }catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage());
        }
    }
}