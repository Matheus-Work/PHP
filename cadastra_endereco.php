<?php 

    include "database.php";

    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $ibge = $_POST['ibge'];

    $sql = "INSERT INTO enderecos (cep, rua, numero,  bairro, cidade, uf, ibge) 
    VALUES ('$cep', '$rua', '$numero', '$bairro', '$cidade', '$uf', '$ibge')";


    if(mysqli_query($conexao, $sql)){
        header("Location: form_cadastro_despesas.php");
    }
    else{
        echo "Falha ao cadastrar no banco de dados";
    }