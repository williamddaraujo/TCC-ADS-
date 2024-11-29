<?php

    if(isset($_POST['submit']))
    {
        print_r('Nome: ' . $_POST['Nome']);
        print_r('<br>');
        print_r('Turma: ' . $_POST['Turma']);
        print_r('<br>');
        print_r('Tel: ' . $_POST['Tel']);
        print_r('<br>');
        print_r('Excel: ' . $_POST['Excel']);
        print_r('<br>');
        print_r('Word: ' . $_POST['Word']);
        print_r('<br>');
        print_r('PowerPoint: ' . $_POST['PowerPoint']);
        print_r('<br>');
        print_r('Logica: ' . $_POST['Logica']);
        print_r('<br>');
        print_r('Games: ' . $_POST['Games']);
        print_r('<br>');
        print_r('HTML: ' . $_POST['HTML']);
        print_r('<br>');

        include_once('conf.php');

        $Nome = $_POST['Nome'];
        $Turma = $_POST['Turma'];
        $Tel = $_POST['Tel'];
        $Excel = $_POST['Excel'];
        $Word = $_POST['Word'];
        $PowerPoint = $_POST['PowerPoint'];
        $Logica = $_POST['Logica'];
        $Games = $_POST['Games'];
        $HTML = $_POST['HTML'];

        $result = mysqli_query($conexao, "INSERT INTO alunos(Nome,Turma,Tel,Excel,Word,PowerPoint,Logica,Games,HTML) 
        VALUES ('$Nome','$Turma','$Tel','$Excel','$Word','$PowerPoint','$Logica','$Games','$HTML')");

header("Location: formulario.php");
    exit();

}
session_start();
    
if((!isset($_SESSION['matricula']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['matricula']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
$logado = $_SESSION['matricula'];





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            number-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #PowerPointimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit {
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }

        #export{

            background-color: #4CAF50;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px; 

        }

        #export:hover{background-color: #00802b;
        }
        #visualizar:hover{background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));}
        #visualizar{

            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 92%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            text-align: center;
            
        }

        #export, #visualizar {
            display: inline-block;}


        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        p{font-size:35px;}

        legend{font-size:19px;}
        
    </style>
</head>
<body>
    <a href="home.php">Voltar</a>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Informações do aluno</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="Nome" id="Nome" class="inputUser" required>
                    <label for="Nome" class="labelInput">Nome</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="Turma" id="Turma" class="inputUser" required>
                    <label for="Turma" class="labelInput">Turma</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="Tel" name="Tel" id="Tel" class="inputUser" required>
                    <label for="Tel" class="labelInput">Telefone</label>
                </div>
                
                <b><p >Notas</p></b>
                
                <div class="inputBox">
                    <input type="number" name="Excel" id="Excel" class="inputUser"   step="0.1" max="10">
                    <label for="Excel" >Excel</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="Word" id="Word" class="inputUser" max="10"  step="0.1">
                    <label for="Word" >Word</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="PowerPoint" id="PowerPoint" class="inputUser"  max="10" step="0.1">
                    <label for="PowerPoint" c>PowerPoint</label>
                </div>
                
                <br>
                <div class="inputBox">
                    <input type="number" name="Logica" id="Logica" class="inputUser" max="10"  step="0.1">
                    <label for="Logica" >Logica</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="Games" id="Games" class="inputUser" max="10"  step="0.1">
                    <label for="Games" >Games</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="HTML" id="HTML" class="inputUser" max="10"  step="0.1">
                    <label for="HTML" >HTML</label>
                </div>
               
                
                
                <br>
                <input type="submit" name="submit" id="submit"value="Enviar"><br><br>
                <button type="button" id="export" onclick="window.location.href='export_xlsx.php'">Exportar XLSX</button>            
                
                <br>
                <!-- Link para visualizar todos os alunos -->

</fieldset>
            </form><br>
            <a href="visualizar_alunos.php" id="visualizar">Ver todos os alunos</a>
    </div>

    <script>
    document.geTElementById('meuFormulario').addEventListener('submit', function(event) {
      event.preventDefault(); // Impede o envio padrão do formulário
      // Não faz nada com os dados, apenas previne o envio
      
    });
  </script>
  <script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'formulario.php?search='+search.value;
    }
</script>

</body>
<video autoplay muted loop class="video-background">
        <source src="img/log.mp4" type="video/mp4">
        Seu navegador não suporta a tag de vídeo.
    </video>
</html>