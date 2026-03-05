<?php
require __DIR__ . '/vendor/autoload.php';
use Ramsey\Uuid\Uuid;
session_start();
$pdo=new PDO('mysql:host=localhost;dbname=notes','root','');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ← hashed password here
    $uuid = Uuid::uuid4();
    $stmt = $pdo->prepare('INSERT INTO users (username, password,uuid) VALUES (?, ?,?);');
    $stmt->execute([$username, $password,$uuid->toString()]);
    $uuidtk =str_replace('-','',$uuid->toString());
    $_SESSION['uuidtk'] = $uuidtk;

    //criando banco de dados com o nome do uuid do usuário
    $pdo->exec("CREATE table IF NOT EXISTS `{$uuidtk}`(id INT AUTO_INCREMENT PRIMARY KEY, mensagem VARCHAR(255), importante BOOLEAN);");
    header('Location: index.php');
    exit();
}