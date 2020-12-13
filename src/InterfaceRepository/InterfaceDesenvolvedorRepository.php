<?php

declare(strict_types=1);

namespace App\InterfaceRepository;

use App\Entity\Desenvolvedor as DesenvolvedorEntity;

interface  InterfaceDesenvolvedorRepository
{
    public function getAll():array;
    public function getByPagination(int $limit, int $offset):array;
    public function getById(int $id):DesenvolvedorEntity;
    public function save(DesenvolvedorEntity $desenvolvedor):void;
    public function update(int $id,DesenvolvedorEntity $desenvolvedor):void;
    public function delete(int $id):void;
    public function count():int;
}