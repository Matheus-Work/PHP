<?php require('database.php');?>
<!DOCTYPE html>
<html lang="pt-br">
	<head><meta charset="utf-8">
	<title>Lista de Despesas</title>
	<head>
	<body>
		<?php
		$datahoje = date('d-m-Y-s');
		$arquivo = 'Relatório Despesas'.$datahoje.'.xls';
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="7"><center><b>Lista de Despesas</b></center></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>VALOR</b></td>';
		$html .= '<td><b>DATA_COMPRA</b></td>';
		$html .= '<td><b>DESCRICAO_DESPESA</b></td>';
		$html .= '<td><b>TIPO_PAGAMENTO_ID</b></td>';
		$html .= '<td><b>CATEGORIA_ID</b></td>';
		$html .= '<td><b>ENDERECO_ID</b></td>';
		$html .= '</tr>';
	mysqli_set_charset($conexao,"utf8");	
	$result_sql = "SELECT * FROM despesas";
	$result_query = mysqli_query($conexao, $result_sql);
	while($linha = mysqli_fetch_assoc($result_query)){
		$html .= '<tr>';
		$html .= '<td>'.$linha["id"].'</td>';
		$html .= '<td>'.$linha["valor"].'</td>';
		$html .= '<td>'.$linha["data_compra"].'</td>';
		$html .= '<td>'.$linha["descricao_despesa"].'</td>';
		$html .= '<td>'.$linha["tipo_pagamento_id"].'</td>';
		$html .= '<td>'.$linha["categoria_id"].'</td>';
		$html .= '<td>'.$linha["endereco_id"].'</td>';
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