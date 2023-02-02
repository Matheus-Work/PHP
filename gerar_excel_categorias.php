<?php require('database.php');?>
<!DOCTYPE html>
<html lang="pt-br">
	<head><meta charset="utf-8">
	<title>Lista de Categoria</title>
	<head>
	<body>
		<?php
		$datahoje = date('d-m-Y-s');
		$arquivo = 'Relatório Categoria'.$datahoje.'.xls';
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="3"><center><b>Lista de Categorias</b></center></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>NOME</b></td>';
		$html .= '<td><b>DESCRICAO</b></td>';
		$html .= '</tr>';
	mysqli_set_charset($conexao,"utf8");	
	$result_sql = "SELECT * FROM categorias";
	$result_query = mysqli_query($conexao, $result_sql);
	while($linha = mysqli_fetch_assoc($result_query)){
		$html .= '<tr>';
		$html .= '<td>'.$linha["id"].'</td>';
		$html .= '<td>'.$linha["nome_categoria"].'</td>';
		$html .= '<td>'.$linha["descricao"].'</td>';
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