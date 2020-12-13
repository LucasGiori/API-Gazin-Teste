<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Entity\Desenvolvedor as DesenvolvedorEntity;
use App\Database\Connection;
use App\Repository\Desenvolvedor as DesenvolvedorRepository;
use App\Service\Desenvolvedor as DesenvolvedorService;
use Psr\Http\Message\ServerRequestInterface;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;


final class SaveDesenvolvedorHandler extends BaseHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response,$args) : ResponseInterface
    {
        try{
            $desenvolvedor = $this->serializer->deserialize(
                $request->getBody()->getContents(),
                DesenvolvedorEntity::class,
                'json'
            );
            $desenvolvedorRepository =  new DesenvolvedorRepository(new Connection());
            $desenvolvedorService = new DesenvolvedorService($desenvolvedorRepository);
            $desenvolvedorService->save($desenvolvedor);
            $response->getBody()->write($this->serializer->serialize(["message"=>"Desenvolvedor cadastrado com sucesso!"],'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_CREATED);
        }catch(Exception $e){
            $response->getBody()->write($this->serializer->serialize(["message"=>"Desenvolvedor não cadastrado!","erro"=>$e->getMessage()],'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }
}