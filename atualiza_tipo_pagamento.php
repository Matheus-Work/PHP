<?php 

    include "database.php";

    session_start();
    $id_pag =  $_POST['id_pag'];
    $tipo = $_POST['tipo'];
  
    $sql = "UPDATE tipos_pagamento SET tipo = '$tipo'
    WHERE tipos_pagamento.id_pag = $id_pag;";

  

    $_SESSION['mensagem'] = "Tipos de Pagamentos Atualizados com Sucesso!!!";

    if(mysqli_query($conexao, $sql)){
        
        header("Location:listar_tipo_pagamento.php");
    }
    else{
        echo "Falha ao atualizar no banco de dados";
    }