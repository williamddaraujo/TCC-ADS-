<?php
    session_start();
    if (isset($_POST['submit']) && !empty($_POST['matricula']) && !empty($_POST['senha'])) {
        include_once('config.php');
        
        $matricula = $conexao->real_escape_string($_POST['matricula']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        $sql = "SELECT * FROM usuario WHERE matricula = '$matricula' AND senha = '$senha'";
        $result = $conexao->query($sql);

        if ($result && $result->num_rows > 0) {
            $_SESSION['matricula'] = $matricula;
            $_SESSION['senha'] = $senha;
            header('Location: sistema.php');
        } else {
            unset($_SESSION['matricula']);
            unset($_SESSION['senha']);
            header('Location: login.php');
        }
    } else {
        header('Location: login.php');
    }
?>
