<?php 

    include "database.php";

    session_start();

    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO tipos_pagamento (tipo) 
    VALUES ('$tipo')";


    $_SESSION['mensagem'] = "Tipo de Pagamento Cadastrado com Sucesso!!!";
    if(mysqli_query($conexao, $sql)){
        header("Location:form_cadastra_pag_cat_cep.php");
    }
    else{
        echo "Falha ao cadastrar no banco de dados";
    }