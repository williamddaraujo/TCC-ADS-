<style>
    /* Estilos gerais para o corpo da página */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        margin: 0;
        padding: 20px;
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
    /* Estilos para o título */
    h2 {
        color: #fff;
        font-size: 80px;
        text-align:center;
    
    }

    /* Estilos para o título do formulário */
    h3 {
        color: #fff;
        font-size: 80px;
        text-align:center;
    }

    /* Estilos para os links */
    a {
        color: #4CAF50;
        text-decoration: none;
        font-size: 14px;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Estilos para a tabela */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 12px;
        text-align: center;
        font-size: 14px;
    }

    table th {
        background-color: #4CAF50;
        color: white;
    }

    table td {
        background-color: #ffffff;
        color: #333;
    }

    table tr:nth-child(even) td {
        background-color: #f2f2f2;
    }

    table tr:hover td {
        background-color: #e9f5e1;
    }

    /* Estilos para os botões de editar e excluir */
    .btn-editar, .btn-excluir {
        padding: 8px 15px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        display: inline-block;
        margin: 2px 5px;
    }

    .btn-editar {
        background-color: #4CAF50;
    }

    .btn-editar:hover {
        background-color: #45a049;
    }

    .btn-excluir {
        background-color: #f44336;
    }

    .btn-excluir:hover {
        background-color: #da190b;
    }

    /* Estilos para o formulário de edição */
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
    }

    form label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        color: #555;
    }

    form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        background-color: #f9f9f9;
    }

    form input:focus {
        border-color: #4CAF50;
        outline: none;
        background-color: #f1f9f1;
    }

    form button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
    }

    form button:hover {
        background-color: #45a049;
    }

    /* Responsividade para dispositivos móveis */
    @media (max-width: 768px) {
        table, form {
            width: 100%;
        }

        form {
            padding: 15px;
        }
    }

    
</style>





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

// Verifica se o parâmetro 'delete' foi passado para excluir um aluno
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM alunos WHERE id_alunos = '$id'";
    if ($conexao->query($deleteQuery) === TRUE) {
        echo "<script>alert('Aluno excluído com sucesso'); window.location.href='visualizar_alunos.php';</script>";
    } else {
        echo "Erro ao excluir aluno: " . $conexao->error;
    }
}

// Se o formulário de edição for enviado
if (isset($_POST['update'])) {
    $id_aluno = $_POST['id_aluno'];
    $nome = trim($_POST['Nome']);
    $turma = trim($_POST['Turma']);
    $tel = trim($_POST['Tel']);
    $excel = trim($_POST['Excel']);
    $word = trim($_POST['word']);
    $powerpoint = trim($_POST['PowerPoint']);
    $logica = trim($_POST['Logica']);
    $games = trim($_POST['Games']);
    $html = trim($_POST['HTML']);

    // Validação: campos obrigatórios
    if (empty($nome) || empty($turma) || empty($tel)) {
        echo "<script>alert('Erro: Nome, Turma e Telefone são campos obrigatórios.'); window.history.back();</script>";
        exit();
    }

    // Validação: notas devem ser numéricas entre 0 e 10 (se preenchidas)
    $camposNotas = [
        'Excel' => $excel,
        'Word' => $word,
        'PowerPoint' => $powerpoint,
        'Logica' => $logica,
        'Games' => $games,
        'HTML' => $html,
    ];

    foreach ($camposNotas as $campo => $valor) {
        if ($valor !== '' && (!is_numeric($valor) || $valor < 0 || $valor > 10)) {
            echo "<script>alert('Erro: O campo \"$campo\" deve conter uma nota numérica entre 0 e 10 ou ser deixado vazio.'); window.history.back();</script>";
            exit();
        }
    }

    // Atualiza os dados no banco de dados
    $updateQuery = "UPDATE alunos SET 
        Nome = '$nome', 
        Turma = '$turma', 
        Tel = '$tel', 
        Excel = " . ($excel !== '' ? "'$excel'" : "NULL") . ", 
        word = " . ($word !== '' ? "'$word'" : "NULL") . ", 
        PowerPoint = " . ($powerpoint !== '' ? "'$powerpoint'" : "NULL") . ", 
        Logica = " . ($logica !== '' ? "'$logica'" : "NULL") . ", 
        Games = " . ($games !== '' ? "'$games'" : "NULL") . ", 
        HTML = " . ($html !== '' ? "'$html'" : "NULL") . " 
        WHERE id_alunos = '$id_aluno'";

    if ($conexao->query($updateQuery) === TRUE) {
        echo "<script>alert('Aluno atualizado com sucesso'); window.location.href='visualizar_alunos.php';</script>";
    } else {
        echo "Erro ao atualizar aluno: " . $conexao->error;
    }
}

// Consulta os dados dos alunos
$sql = "SELECT * FROM alunos";
$result = $conexao->query($sql);

// Exibir o formulário de edição se o parâmetro 'edit' for passado
if (isset($_GET['edit'])) {
    $id_aluno = $_GET['edit'];
    $sqlEdit = "SELECT * FROM alunos WHERE id_alunos = '$id_aluno'";
    $resultEdit = $conexao->query($sqlEdit);
    $aluno = $resultEdit->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Alunos</title>
    <style>
        /* Estilos básicos para tabela e botões */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-editar, .btn-excluir {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-editar {
            background-color: #4CAF50;
        }
        .btn-editar:hover {
            background-color: #45a049;
        }
        .btn-excluir {
            background-color: #f44336;
        }
        .btn-excluir:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <h2>Lista de Alunos</h2>
    <a href="formulario.php">Voltar para o Formulário</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Turma</th>
                <th>Telefone</th>
                <th>Excel</th>
                <th>Word</th>
                <th>PowerPoint</th>
                <th>Lógica</th>
                <th>Games</th>
                <th>HTML</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_alunos'] . "</td>";
                        echo "<td>" . $row['Nome'] . "</td>";
                        echo "<td>" . $row['Turma'] . "</td>";
                        echo "<td>" . $row['Tel'] . "</td>";
                        echo "<td>" . $row['Excel'] . "</td>";
                        echo "<td>" . $row['word'] . "</td>";
                        echo "<td>" . $row['PowerPoint'] . "</td>";
                        echo "<td>" . $row['Logica'] . "</td>";
                        echo "<td>" . $row['Games'] . "</td>";
                        echo "<td>" . $row['HTML'] . "</td>";
                        echo "<td>
                                <a href='visualizar_alunos.php?edit=" . $row['id_alunos'] . "' class='btn-editar'>Editar</a>
                                <a href='visualizar_alunos.php?delete=" . $row['id_alunos'] . "' class='btn-excluir' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Nenhum aluno encontrado</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <!-- Formulário de Edição -->
    <?php if (isset($_GET['edit'])): ?>
        <h3>Editar Notas</h3>
        <form method="POST" action="visualizar_alunos.php">
    <input type="hidden" name="id_aluno" value="<?= $aluno['id_alunos']; ?>">

    <label for="Nome">Nome:</label>
    <input type="text" name="Nome" value="<?= $aluno['Nome']; ?>" required><br>

    <label for="Turma">Turma:</label>
    <input type="text" name="Turma" value="<?= $aluno['Turma']; ?>" required><br>

    <label for="Tel">Telefone:</label>
    <input type="text" name="Tel" value="<?= $aluno['Tel']; ?>" required><br>

    <label for="Excel">Excel:</label>
    <input type="number" name="Excel" value="<?= $aluno['Excel']; ?>" min="0" max="10" ><br>

    <label for="word">Word:</label>
    <input type="number" name="word" value="<?= $aluno['word']; ?>" min="0" max="10" ><br>

    <label for="PowerPoint">PowerPoint:</label>
    <input type="number" name="PowerPoint" value="<?= $aluno['PowerPoint']; ?>" min="0" max="10" ><br>

    <label for="Logica">Lógica:</label>
    <input type="number" name="Logica" value="<?= $aluno['Logica']; ?>" min="0" max="10" ><br>

    <label for="Games">Games:</label>
    <input type="number" name="Games" value="<?= $aluno['Games']; ?>" min="0" max="10" ><br>

    <label for="HTML">HTML:</label>
    <input type="number" name="HTML" value="<?= $aluno['HTML']; ?>" min="0" max="10" ><br><br>

    <button type="submit" name="update">Atualizar</button>
</form>

    <?php endif; ?>
</body>
<video autoplay muted loop class="video-background">
        <source src="img/log.mp4" type="video/mp4">
        Seu navegador não suporta a tag de vídeo.
    </video>
</html>
