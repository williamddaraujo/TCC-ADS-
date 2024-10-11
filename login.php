<?php
    session_start();
    include_once('config.php');

    if (isset($_POST['submit']) && !empty($_POST['matricula']) && !empty($_POST['senha'])) {
        $matricula = $conexao->real_escape_string($_POST['matricula']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        $sql = "SELECT * FROM usuario WHERE matricula = '$matricula' AND senha = '$senha'";
        $result = $conexao->query($sql);

        if ($result && $result->num_rows > 0) {
            $_SESSION['matricula'] = $matricula;
            $_SESSION['senha'] = $senha;
            header('Location: formulario.php');
            exit();
        } else {
            unset($_SESSION['matricula']);
            unset($_SESSION['senha']);
            $error = "Matrícula ou senha incorretos.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        div {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 40px;
            border-radius: 15px;
            color: #fff;
            width: 300px;
        }
        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
            width: 100%;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .inputSubmit {
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
        .inputSubmit:hover {
            background-color: deepskyblue;
        }
        a {
            color: white;
            text-decoration: none;
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 16px;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<a href="home.php">Voltar</a>

    <video autoplay muted loop class="video-background">
        <source src="img/log.mp4" type="video/mp4">
        Seu navegador não suporta a tag de vídeo.
    </video>
    <div>
        <h1>Login</h1>
        <?php if (isset($error)) { echo '<p class="error">' . $error . '</p>'; } ?>
        <form action="login.php" method="POST">
            <input type="text" name="matricula" placeholder="matrícula" required>
            <input type="password" name="senha" placeholder="senha" required>
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
