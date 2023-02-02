<?php
    require("database.php");

    $despesas_id = $_GET["id"];


    $sql_delete = "DELETE FROM despesas WHERE 
    despesas.id = '$despesas_id'";


    if(mysqli_query($conexao, $sql_delete))
    {
        header("Location: listar_despesas.php");   
    }
    else
    {
        echo "Erro ao excluir o arquivo";
    }

    