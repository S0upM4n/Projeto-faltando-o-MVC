<?php

class ALUNOS{
    public $nome;
    public $sobrenome;
    public $idade;

    function __construct($nome, $sobrenome, $idade){
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->idade = $idade;
    }

    function exibirDados(){
        echo "Nome: " . $this->nome . "<br>";
        echo "Sobrenome: " . $this->sobrenome . "<br>";
        echo "Idade: " . $this->idade . "<br>";
    }
}