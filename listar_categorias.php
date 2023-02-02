<?php       
    
    require("database.php");
    require("header.php");

    session_start();
    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual:1;

    $qtd_result_pg = 6;

    $inicio = ($qtd_result_pg * $pagina) - $qtd_result_pg;

    $sql = "SELECT * FROM categorias LIMIT $inicio, $qtd_result_pg";
    $resultado = mysqli_query($conexao, $sql);
?>

<style>
  .paginacao{
    display:flex;
    align-items:center;
    justify-content:center;
  }
  .botaopdf{
    display:flex;
    align-items:flex-end;
    justify-content:flex-end;
  }
  .corpdf{
    color:white;
  }
</style>

<div class="container mt-3">
  <h3>Lista de Categorias</h3>
  <hr>
  <div class="botaopdf">
    <button type="button" class="btn btn-success" style="margin-right: 10px;">
    <a class="corpdf" href="gerar_excel_categorias.php">Gerar Excel</a></button>
    <button type="button" class="btn btn-danger"><a class="corpdf"href="gerar_pdf_categorias.php">Gerar PDF</a></button>
  </div>
  <table class="table table-striped">
    <thead>        
      <tr>
        <th>Id:</th>
        <th>Nome: </th>
        <th>Descrição: </th>
        <th>Atualizar: </th>
        <th>Excluir: </th>
      </tr>
    </thead>
    <tbody>
      <?php while($listar_categorias = mysqli_fetch_assoc($resultado)){  ?>
          <tr>
              <td><?php echo $listar_categorias['id'];?></td>
              <td><?php echo $listar_categorias['nome_categoria'];?></td>
              <td><?php echo $listar_categorias['descricao'];?></td>
              <td><a href="form_atualiza_categorias.php?id=<?php echo $listar_categorias['id'];?>">ATUALIZAR</a></td>
              <td><a href="excluir_categorias.php?id=<?php echo $listar_categorias['id'];?>">EXCLUIR</a></td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php
$result_pg = "SELECT COUNT(id) AS num_result FROM categorias";
$resultado_pg = mysqli_query($conexao, $result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);
// echo $row_pg['num_result'];
$quantidade_pg = ceil($row_pg['num_result'] / $qtd_result_pg);

$max_links = 2;
?>
<div class="paginacao">
  <?php
  echo "<a href='listar_categorias.php?pagina=1'>Primeira </a>";
  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina -1; $pag_ant++){
  if($pag_ant >= 1){
    echo "-";
    echo "<a href='listar_categorias.php?pagina=$pag_ant'> $pag_ant </a>";
  }
  }
  echo "-";
  echo " $pagina ";
  echo "-";

  for($pag_dep = $pagina + 1; $pag_dep<= $pagina + $max_links; $pag_dep++){
  if($pag_dep <= $quantidade_pg){
    echo "<a href='listar_categorias.php?pagina=$pag_dep'> $pag_dep </a>";
    echo "-";
  }
  }
  echo "<a href='listar_categorias.php?pagina=$quantidade_pg'> Ultima</a>";
  ?>
</div>

<?php       
    require("footer.php");
?>
      