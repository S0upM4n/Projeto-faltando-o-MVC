<?php
$error = isset($_GET['error']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloco de notas</title>
    <style>
        .error{
            border-color: red;
        }
    </style>
</head>
<body>
    
<form action="login.php" method="POST">
<input type="text" name="username" placeholder="Username" required class="<?php if($error) echo 'error'; ?>">
<input type="password" name="password" placeholder="Password" required class="<?php if($error) echo 'error'; ?>">
<input type="submit" value="Send">
<p><?php if($error){echo"Login ou senha não reconhecido";} ?></p>
</form>
<p>Não possui uma conta? <a href="register.php">Cadastre-se</a></p>


</body>
</html>