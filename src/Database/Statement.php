<?php 

declare(strict_types=1);


namespace App\Database;

use PDOException;
use PDOStatement;
use App\Database\Exception\SintaxeErrorException;
use App\Database\Exception\TabelaInexistenteException;
use App\Database\Exception\PrimaryKeyViolated;

class Statement extends PDOStatement
{
    public function execute($input_parameters = null)
    {
        try{
            parent::execute($input_parameters);
        }catch(PDOException $e){            
            switch ( $e->getCode() ){//$e->errorInfo[1]
                case '42P01':
                    throw new TabelaInexistenteException($e->getMessage());
                    break;
                case '42703':
                    throw new SintaxeErrorException($e->getMessage());
                    break;
                case '23505':
                    throw new PrimaryKeyViolated($e->getMessage());
                    break;            
                default:
                    throw $e;
                    break;
            }
        }
    }
}