<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem = $_POST['mensagem'];
    $importante = isset($_POST['importante']) ? 1 : 0;

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=notes', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Validate and sanitize the table name stored in session (uuid without hyphens)
        $uuidtk = isset($_SESSION['uuidtk']) ? $_SESSION['uuidtk'] : '';
        $uuidtk = preg_replace('/[^0-9a-f]/i', '', $uuidtk); // keep hex only

        if (strlen($uuidtk) !== 32) {
            echo 'Identificador inválido ou não autenticado.';
        } else {
            $table = $uuidtk; // safe: only hex, fixed length
            $stmt = $pdo->prepare("INSERT INTO `{$table}` (mensagem, importante) VALUES (?, ?)");
            $stmt->execute([$mensagem, $importante]);
            header('Location: dashboard.php');
            exit();
        }
    } catch (PDOException $e) {
        echo 'Erro de banco de dados: ' . htmlspecialchars($e->getMessage());
    }
} else {
    header('Location: dashboard.php');
    exit();
}