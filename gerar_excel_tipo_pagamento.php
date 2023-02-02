<?php require('database.php');?>
<!DOCTYPE html>
<html lang="pt-br">
	<head><meta charset="utf-8">
	<title>Lista de Tipos de Pagamentos</title>
	<head>
	<body>
		<?php
		$datahoje = date('d-m-Y-s');
		$arquivo = 'Relatório Tipos de Pagamentos'.$datahoje.'.xls';
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="2"><center><b>Lista de Tipos de Pagamentos</b></center></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>TIPO</b></td>';
		$html .= '</tr>';
	mysqli_set_charset($conexao,"utf8");	
	$result_sql = "SELECT * FROM tipos_pagamento";
	$result_query = mysqli_query($conexao, $result_sql);
	while($linha = mysqli_fetch_assoc($result_query)){
		$html .= '<tr>';
		$html .= '<td>'.$linha["id_pag"].'</td>';
		$html .= '<td>'.$linha["tipo"].'</td>';
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