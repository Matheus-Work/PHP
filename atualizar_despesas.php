<?php 

    include "database.php";

    session_start();
    $id =  $_POST['id'];
    $valor = $_POST['valor'];
    $data_compra = $_POST['data_compra'];
    $descricao_despesa = $_POST['descricao_despesa'];

    
    
  
    $sql = "UPDATE despesas SET valor = '$valor',
    data_compra = '$data_compra', descricao_despesa = '$descricao_despesa'
    WHERE despesas.id = $id;";

  

    $_SESSION['mensagem'] = "Despesas Atualizadas com Sucesso!!!";

    if(mysqli_query($conexao, $sql)){
        
        header("Location:listar_despesas.php");
    }
    else{
        echo "Falha ao atualizar no banco de dados";
    }