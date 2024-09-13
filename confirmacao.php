<?php
session_start(); // Inicia a sessão

if (isset($_POST['submit'])) {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $Turma = $_POST['Turma'];
    $tel = $_POST['tel'];
    $Excel = $_POST['Excel'];
    $Word = $_POST['Word'];
    $PowerPoint = $_POST['PowerPoint'];
    $Logica = $_POST['Logica'];
    $Games = $_POST['Games'];
    $HTML = $_POST['HTML'];

    // Inclua o arquivo de conexão com o banco de dados
    include_once('conf.php');

    // Insere os dados no banco de dados
    $result = mysqli_query($conexao, "INSERT INTO alunos(nome, Turma, tel, Excel, Word, PowerPoint, Logica, Games, HTML) 
    VALUES ('$nome', '$Turma', '$tel', '$Excel', '$Word', '$PowerPoint', '$Logica', '$Games', '$HTML')");

    // Define uma mensagem de sucesso na sessão
    $_SESSION['message'] = 'O formulário foi enviado com sucesso!';

    // Redireciona para a mesma página para exibir a mensagem
    header("Location: formulario.php");
    exit();
}
?>
