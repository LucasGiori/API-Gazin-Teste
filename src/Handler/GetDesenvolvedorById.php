<?php

declare(strict_types=1);

namespace App\Handler;


use Exception;
use App\Database\Connection;
use App\Repository\Desenvolvedor as DesenvolvedorRepository;
use App\Service\Desenvolvedor as DesenvolvedorService;
use Psr\Http\Message\ServerRequestInterface;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;


final class GetDesenvolvedorById extends BaseHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response,$args) : ResponseInterface
    {   
        try{
            if(!(int)$args['id']){
                throw new Exception('Argumento inválido!');
            } 
            $desenvolvedorRepository =  new DesenvolvedorRepository(new Connection());
            $desenvolvedorService = new DesenvolvedorService($desenvolvedorRepository);                
            $desenvolvedor = $desenvolvedorService->getById((int)$args['id']);
            $response->getBody()->write($this->serializer->serialize($desenvolvedor,'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_OK);
        }catch(Exception $e){
            $response->getBody()->write($this->serializer->serialize(['message'=>$e->getMessage()],'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }
}