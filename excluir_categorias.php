<?php
    require("database.php");

    $categorias_id = $_GET["id"];

    $sql_delete = "DELETE FROM categorias WHERE 
    categorias.id = '$categorias_id'";

    if(mysqli_query($conexao, $sql_delete))
    {
        header("Location: listar_categorias.php");   
    }
    else
    {
        echo "Erro ao excluir o arquivo";
    }

    