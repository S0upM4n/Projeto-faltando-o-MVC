<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bloco de notas:registrar</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>

        </nav>
    </header><br><br><br>
    <div style="width: 60%; display: flex; flex-direction: column ; align-items: center; height: 40vh; justify-content: center; background-color: bisque; margin:auto">
    <form action="cadastro.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Register">
    </form>


    <p>já possui uma conta? <a href="index.php">Faça login</a></p>
        </div>
</body>
</html>