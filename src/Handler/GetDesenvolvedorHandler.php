<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Database\Connection;
use App\Repository\Desenvolvedor as DesenvolvedorRepository;
use App\Service\Desenvolvedor as DesenvolvedorService;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;


final class GetDesenvolvedorHandler extends BaseHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        try{
            $desenvolvedorRepository =  new DesenvolvedorRepository(new Connection());
            $desenvolvedorService = new DesenvolvedorService($desenvolvedorRepository);

            $queryParams = $request->getQueryParams();
            if(!empty($queryParams['page'])){
                $count = $desenvolvedorService->count();
                $limit = (int)($queryParams['limit'] ?? 10);
                $page = (int)($queryParams['page'] ?? 1);

                $offset = ($page-1) * $limit;//A partir do registro ..
                $desenvolvedores = $desenvolvedorService->getByPagination($limit,$offset);
                $pagination = [
                    'count'=>$count,
                    'page'=>$page,
                    'previous'=> $page-1 < 1 ? 1 : $page-1,
                    'next'=>$page+1,
                    'limit'=>$limit
                ];
            }else{
                $desenvolvedores = $desenvolvedorService->getAll();
                $pagination =[];
            }            
            $result = [
                'data'=>$desenvolvedores,
                'pagination'=>$pagination
            ];            
            
            $response->getBody()->write($this->serializer->serialize($result,'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_OK);
        }catch(Exception $e){
            $response->getBody()->write($this->serializer->serialize(['message'=>$e->getMessage()],'json'));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }
}