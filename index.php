<?php

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/' . $class_name . '.php';
});
$aluno1 = new ALUNOS("João", "Silva", 20);
$aluno1->exibirDados();