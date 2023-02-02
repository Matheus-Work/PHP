<?php       
    // require _DIR_.'dompdf/vendor/autoload.php';
    // require("database.php");

    // $query_usuarios = "SELECT valor, data_compra, descricao_despesa,
    // tipo_pagamento_id, categoria_id FROM despesas";

    // $result_usuarios = $conexao -> prepare($query_usuarios);

    // $result_usuarios -> execute();

    // while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
    //     var_dump($row_usuario);
    // }


    // require("footer.php");
    require("database.php");
    $sql = "SELECT * FROM despesas";
    $res = $conexao->query($sql);

    if($res -> num_rows > 0){
        $html = "<table border = 2> justify-content:center; align-items:center";
        while($row = $res -> fetch_object()){
            $html .= "<tr>";
            $html .= "<td>". $row->id."</td>";
            $html .= "<td>". $row->valor."</td>";
            $html .= "<td>". $row->data_compra."</td>";
            $html .= "<td>". $row->descricao_despesa."</td>";
            $html .= "<td>". $row->tipo_pagamento_id."</td>";
            $html .= "<td>". $row->categoria_id."</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    }

    use Dompdf\Dompdf;


    require 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();

    $dompdf->loadHTML('
        <h1>Relatório de Despesas</h1>
        '.$html);
    $dompdf->set_option('defaultFont', 'sans');
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream();