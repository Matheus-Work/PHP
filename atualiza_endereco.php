<?php 

    include "database.php";

    $id_endereco =  $_POST['id'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $ibge = $_POST['ibge'];
  

    $sql = "UPDATE enderecos SET cep = '$cep',
    rua = '$rua', numero = '$numero',bairro = '$bairro',cidade = '$cidade',
    uf = '$uf',ibge = '$ibge'
    WHERE enderecos.id = $id_endereco;";

    if(mysqli_query($conexao, $sql)){
        header("Location: listar_enderecos.php");
    }
    else{
        echo "Falha ao atualizar no banco de dados";
    }