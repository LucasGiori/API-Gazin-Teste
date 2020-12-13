<?php

declare(strict_types = 1);

namespace App\Service;

use App\Entity\Desenvolvedor as DesenvolvedorEntity;
use App\InterfaceRepository\InterfaceDesenvolvedorRepository;


final class Desenvolvedor
{
    protected $interfaceDesenvolvedorRepository;
    
    public function __construct(InterfaceDesenvolvedorRepository $interfaceDesenvolvedorRepository)
    {
        $this->interfaceDesenvolvedorRepository = $interfaceDesenvolvedorRepository;
    }

    public function getAll():array
    {
        return $this->interfaceDesenvolvedorRepository->getAll();
    }
    public function getByPagination(int $limit, int $offset):array
    {
        return $this->interfaceDesenvolvedorRepository->getByPagination($limit,$offset);
    }
    public function getById(int $id):DesenvolvedorEntity
    {
        return $this->interfaceDesenvolvedorRepository->getById($id);
    }   
    public function save(DesenvolvedorEntity $desenvolvedor):void
    {
        $this->interfaceDesenvolvedorRepository->save($desenvolvedor);
    }
    public function update(int $id,DesenvolvedorEntity $desenvolvedor):void
    {
        $this->interfaceDesenvolvedorRepository->update($id,$desenvolvedor);
    }
    public function delete(int $id):void
    {
        $this->interfaceDesenvolvedorRepository->delete($id);
    }
    public function count():int
    {
        return $this->interfaceDesenvolvedorRepository->count();
    }
}