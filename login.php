<?php

$pdo = new PDO('mysql:host=localhost;dbname=notes','root','');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'];
    $password = $_POST['password']; // ← plain password here

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?;');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    $login = false;
    if ($user && isset($user['password']) && $password == $user['password']) {
        $login = true;
        session_start();

        if($login){
            $_SESSION['uuid'] = $user['uuid'];
            echo "Login bem-sucedido. UUID do usuário: " . $user['uuid'];
            header('Location: dashboard.php');
        exit();
        }

    } else {
        header('Location: index.php?error=1');
        exit();
    }
}
