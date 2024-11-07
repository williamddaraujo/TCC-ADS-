<?php
session_start();
include_once('config.php');  // Conexão com o banco de dados

// Verifica se o usuário está logado
if((!isset($_SESSION['matricula']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['matricula']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit();
}

// Verifica se o parâmetro 'id' está presente na URL para editar um aluno
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do aluno
    $sql = "SELECT * FROM alunos WHERE id_alunos = '$id'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $aluno = $resultado->fetch_assoc();
    } else {
        echo "Aluno não encontrado.";
        exit();
    }
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $turma = $_POST['turma'];
    $tel = $_POST['tel'];
    $excel = $_POST['excel'];
    $word = $_POST['word'];
    $powerpoint = $_POST['powerpoint'];
    $logica = $_POST['logica'];
    $games = $_POST['games'];
    $html = $_POST['html'];

    // Atualiza os dados no banco
    $updateQuery = "UPDATE alunos SET 
        Nome = '$nome',
        Turma = '$turma',
        Tel = '$tel',
        Excel = '$excel',
        word = '$word',
        PowerPoint = '$powerpoint',
        Logica = '$logica',
        Games = '$games',
        HTML = '$html' 
        WHERE id_alunos = '$id'";

    if ($conexao->query($updateQuery) === TRUE) {
        echo "<p>Aluno atualizado com sucesso!</p>";
    } else {
        echo "Erro ao atualizar aluno: " . $conexao->error;
    }
}

// Exibe o formulário com os dados já preenchidos
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h2>Editar Aluno</h2>
    <form action="editar_aluno.php?id=<?php echo $id; ?>" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $aluno['Nome']; ?>" required><br>

        <label for="turma">Turma:</label>
        <input type="text" name="turma" value="<?php echo $aluno['Turma']; ?>" required><br>

        <label for="tel">Telefone:</label>
        <input type="text" name="tel" value="<?php echo $aluno['Tel']; ?>" required><br>

        <label for="excel">Excel:</label>
        <input type="text" name="excel" value="<?php echo $aluno['Excel']; ?>"><br>

        <label for="word">Word:</label>
        <input type="text" name="word" value="<?php echo $aluno['word']; ?>"><br><br>

        <label for="powerpoint">PowerPoint:</label>
        <input type="text" name="powerpoint" value="<?php echo $aluno['PowerPoint']; ?>"><br><br>

        <label for="logica">Lógica:</label>
        <input type="text" name="logica" value="<?php echo $aluno['Logica']; ?>"><br><br>

        <label for="games">Games:</label>
        <input type="text" name="games" value="<?php echo $aluno['Games']; ?>"><br><br>

        <label for="html">HTML:</label>
        <input type="text" name="html" value="<?php echo $aluno['HTML']; ?>"><br><br>

        <button type="submit">Atualizar</button>
    </form>

    <a href="visualizar_alunos.php">Voltar para a lista de alunos</a>
</body>
</html>
