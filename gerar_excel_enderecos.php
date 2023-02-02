<?php require('database.php');?>
<!DOCTYPE html>
<html lang="pt-br">
	<head><meta charset="utf-8">
	<title>Lista de Endereços</title>
	<head>
	<body>
		<?php
		$datahoje = date('d-m-Y-s');
		$arquivo = 'Relatório Endereços'.$datahoje.'.xls';
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="8"><center><b>Lista de Endereços</b></center></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>CEP</b></td>';
		$html .= '<td><b>RUA</b></td>';
		$html .= '<td><b>NUMERO</b></td>';
		$html .= '<td><b>BAIRRO</b></td>';
		$html .= '<td><b>CIDADE</b></td>';
		$html .= '<td><b>UF</b></td>';
		$html .= '<td><b>IBGE</b></td>';
		$html .= '</tr>';
	mysqli_set_charset($conexao,"utf8");	
	$result_sql = "SELECT * FROM enderecos";
	$result_query = mysqli_query($conexao, $result_sql);
	while($linha = mysqli_fetch_assoc($result_query)){
		$html .= '<tr>';
		$html .= '<td>'.$linha["id"].'</td>';
		$html .= '<td>'.$linha["cep"].'</td>';
		$html .= '<td>'.$linha["rua"].'</td>';
		$html .= '<td>'.$linha["numero"].'</td>';
		$html .= '<td>'.$linha["bairro"].'</td>';
		$html .= '<td>'.$linha["cidade"].'</td>';
		$html .= '<td>'.$linha["uf"].'</td>';
		$html .= '<td>'.$linha["ibge"].'</td>';
	    $html .= '</tr>';
			;
		}
		//download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o download
		echo $html;
		exit; ?>
	</body>
</html>