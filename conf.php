<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'w1w2w3';
    $dbName = 'fomularioalunos';
    
    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    // if($conexao->connect_errno)
    //{
    //    echo "Erro";
//}
  //  else
  //   {
  //       echo "Conexão efetuada com sucesso";
  //   }

//?>