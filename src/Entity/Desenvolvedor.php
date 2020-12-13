<?php

declare(strict_types=1);

namespace App\Entity;
use DateTime;
class Desenvolvedor
{
    public int $id;
    public string $nome;
    public string $sexo;
    public int $idade;
    public string $hobby;
    public string $datanascimento;

    public function __construct(){}

    public function getId() :int
    {
        return $this->id;
    }
    public function setId(int $id) :void
    {
        $this->id = $id;
    }
    public function getNome() :string
    {
        return $this->nome;
    }
    public function setNome(string $nome) :void
    {
        $this->nome = $nome;
    }
    public function getSexo():string
    {
        return $this->sexo;
    }
    public function setSexo(string $sexo):void
    {
        $this->sexo = $sexo;
    }
    public function getIdade() :int
    {
        return $this->idade;
    }
    public function setIdade(int $idade) :void
    {
        $this->idade = $idade;
    }
    public function getHobby():string
    {
        return $this->hobby;
    }
    public function setHobby(string $hobby):void
    {
        $this->hobby= $hobby;
    }
    public function getDatanascimento():string
    {
        return $this->datanascimento;
    }
    public function setDataNascimento(string $datanascimento):void
    {
        $this->datanascimento = $datanascimento;
    }
}