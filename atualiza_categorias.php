<?php 

    include "database.php";

    $id_categoria =  $_POST['id'];
    $nome_categoria = $_POST['nome_categoria'];
    $descricao = $_POST['descricao'];
  

    $sql = "UPDATE categorias SET nome_categoria = '$nome_categoria',
    descricao = '$descricao'
    WHERE categorias.id = $id_categoria;";

    if(mysqli_query($conexao, $sql)){
        header("Location: listar_categorias.php");
    }
    else{
        echo "Falha ao atualizar no banco de dados";
    }