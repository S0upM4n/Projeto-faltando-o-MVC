<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anotações</title>
</head>
<body>
    <h1>Bem-vindo ao sistema de anotações!</h1>
    <h3>UUID do usuário: <?php echo isset($_SESSION['uuid']) ? htmlspecialchars($_SESSION['uuid']) : ''; ?></h3>
    <p>Aqui você pode criar, editar e excluir suas anotações.</p>
    <p><a href="logout.php">Sair</a></p>
    <h2>adicionar item:</h2>
    <form action="addnote.php" method="post">
        <input type="text" name="mensagem" placeholder="Digite sua anotação aqui..." required>
        <input type="checkbox" name="importante" value="1"> Importante
        <button type="submit">Adicionar</button>
    </form>
    <ul>
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=notes', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Validate and sanitize the table name stored in session (uuid without hyphens)
            $uuidtk = isset($_SESSION['uuidtk']) ? $_SESSION['uuidtk'] : '';
            $uuidtk = preg_replace('/[^0-9a-f]/i', '', $uuidtk); // keep hex only

            if (strlen($uuidtk) !== 32) {
                echo '<li>Identificador inválido ou não autenticado.</li>';
            } else {
                $table = $uuidtk; // safe: only hex, fixed length
                $sql = "SELECT mensagem, importante FROM `{$table}`";
                $stmt = $pdo->query($sql);
                $notes = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

                if (empty($notes)) {
                    echo '<li>Nenhuma anotação encontrada.</li>';
                } else {
                    foreach ($notes as $note) {
                        $important = !empty($note['importante']) ? ' <strong>(importante)</strong>' : '';
                        echo '<li>' . htmlspecialchars($note['mensagem']) . $important . '</li> <a href="deletenote.php?mensagem=' . urlencode($note['mensagem']) . '">Excluir</a>';
                    }
                }
            }
        } catch (PDOException $e) {
            echo '<li>Erro de banco de dados: ' . htmlspecialchars($e->getMessage()) . '</li>';
        }
        ?>
    </ul>


</body>
</html>
