<?php 

    include "database.php";

    $valor = $_POST['valor'];
    $data_compra = $_POST['data_compra'];
    $descricao_despesa = $_POST['descricao_despesa'];
    $tipo_pagamento_id = $_POST['tipo_pagamento_id'];
    $categoria_id = $_POST['categoria_id'];
    $endereco_id = $_POST['endereco_id'];

    $sql = "INSERT INTO despesas (valor, data_compra, descricao_despesa,  tipo_pagamento_id, categoria_id, endereco_id) 
    VALUES ('$valor', '$data_compra', '$descricao_despesa', '$tipo_pagamento_id', '$categoria_id','$endereco_id')";


    if(mysqli_query($conexao, $sql)){
        header("Location: listar_despesas.php");
    }
    else{
        echo "Falha ao cadastrar no banco de dados";
    }