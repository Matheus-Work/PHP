<?php
    require("database.php");

    $enderecos_id = $_GET["id"];

    $sql_delete = "DELETE FROM enderecos WHERE 
    enderecos.id = '$enderecos_id'";

    if(mysqli_query($conexao, $sql_delete))
    {
        header("Location: listar_enderecos.php");   
    }
    else
    {
        echo "Erro ao excluir o arquivo";
    }

    