<?php
session_start();
if (!isset($_SESSION['uuidtk'])) {
    header('Location: index.php');
    exit();
}
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';
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
        $stmt = $pdo->prepare("DELETE FROM `{$table}` WHERE mensagem = ?");
        $stmt->execute([$mensagem]);
        header('Location: dashboard.php');
        exit();
    }
} catch (PDOException $e) {
    echo 'Erro de banco de dados: ' . htmlspecialchars($e->getMessage());
}