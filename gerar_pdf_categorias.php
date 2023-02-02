<?php       
    require("database.php");
    $sql = "SELECT * FROM categorias";
    $res = $conexao->query($sql);

    if($res -> num_rows > 0){
        $html = "<table border = 2>";
        while($row = $res -> fetch_object()){
            $html .= "<tr>";
            $html .= "<td>". $row->id."</td>";
            $html .= "<td>". $row->nome_categoria."</td>";
            $html .= "<td>". $row->descricao."</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    }

    use Dompdf\Dompdf;


    require 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();

    $dompdf->loadHTML('
        <h1>Relatório de Categorias</h1>
        '.$html);
    $dompdf->set_option('defaultFont', 'sans');
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream();