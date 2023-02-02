<?php       
    require("database.php");
    $sql = "SELECT * FROM enderecos";
    $res = $conexao->query($sql);

    if($res -> num_rows > 0){
        $html = "<table border = 2>";
        while($row = $res -> fetch_object()){
            $html .= "<tr>";
            $html .= "<td>". $row->id."</td>";
            $html .= "<td>". $row->cep."</td>";
            $html .= "<td>". $row->rua."</td>";
            $html .= "<td>". $row->numero."</td>";
            $html .= "<td>". $row->bairro."</td>";
            $html .= "<td>". $row->cidade."</td>";
            $html .= "<td>". $row->uf."</td>";
            $html .= "<td>". $row->ibge."</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    }

    use Dompdf\Dompdf;


    require 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();

    $dompdf->loadHTML('
        <h1>Relatório dos Endereços</h1>
        '.$html);
    $dompdf->set_option('defaultFont', 'sans');
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream();