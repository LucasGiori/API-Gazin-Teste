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


final class DeleteDesenvolvedorHandler extends BaseHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response,$args) : ResponseInterface
    {   
        try{
            if(!(int)$args['id']){
                throw new Exception('Argumento inválido!');
            }
            $desenvolvedorRepository =  new DesenvolvedorRepository(new Connection());
            $desenvolvedorService = new DesenvolvedorService($desenvolvedorRepository);                
            $desenvolvedorService->delete((int)$args['id']);
            return $response->withStatus(StatusCodeInterface::STATUS_NO_CONTENT);
        }catch(Exception $e){
            $response->getBody()->write($this->serializer->serialize(["message"=>"Desenvolvedor não excluído!","erro"=>$e->getMessage()],'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }
}