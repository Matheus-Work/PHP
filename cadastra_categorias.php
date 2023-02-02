<?php 

    include "database.php";

    $nome_categoria = $_POST['nome_categoria'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO categorias (nome_categoria,descricao) 
    VALUES ('$nome_categoria', '$descricao')";

    session_start();


    $_SESSION['cat_mensagem'] = "Categoria Cadastrada com Sucesso!!!";
    if(mysqli_query($conexao, $sql)){
        header("Location:form_cadastra_pag_cat_cep.php");
    }
    else{
        echo "Falha ao cadastrar no banco de dados";
    }

