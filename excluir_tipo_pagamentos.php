<?php
    require("database.php");

    $tipo_pagamentos_id = $_GET["id"];

    $sql_delete = "DELETE FROM tipos_pagamento WHERE 
    tipos_pagamento.id_pag = '$tipo_pagamentos_id'";


    if(mysqli_query($conexao, $sql_delete))
    {
        header("Location: listar_tipo_pagamento.php");   
    }
    else
    {
        echo "Erro ao excluir o arquivo";
    }

    