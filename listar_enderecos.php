<?php       
    
    require("database.php");
    require("header.php");

    session_start();
    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual:1;

    $qtd_result_pg = 6;

    $inicio = ($qtd_result_pg * $pagina) - $qtd_result_pg;

    $sql = "SELECT * FROM enderecos LIMIT $inicio, $qtd_result_pg";
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
  <h3>Lista de Endereços</h3>
  <hr>
  <div class="botaopdf">
    <button type="button" class="btn btn-success" style="margin-right: 10px;">
    <a class="corpdf" href="gerar_excel_enderecos.php">Gerar Excel</a></button>
    <button type="button" class="btn btn-danger"><a class="corpdf"href="gerar_pdf_enderecos.php">Gerar PDF</a></button>
  </div>
  <table class="table table-striped">
    <thead>        
      <tr>
        <th>Id:</th>
        <th>CEP: </th>
        <th>Rua: </th>
        <th>Número: </th>
        <th>Bairro: </th>
        <th>Cidade: </th>
        <th>UF: </th>
        <th>IBGE: </th>
        <th>Atualizar: </th>
        <th>Excluir: </th>
      </tr>
    </thead>
    <tbody>
        <?php while($listar_enderecos = mysqli_fetch_assoc($resultado)){  ?>
            <tr>
                <td><?php echo $listar_enderecos['id'];?></td>
                <td><?php echo $listar_enderecos['cep'];?></td>
                <td><?php echo $listar_enderecos['rua'];?></td>
                <td><?php echo $listar_enderecos['numero'];?></td>
                <td><?php echo $listar_enderecos['bairro'];?></td>
                <td><?php echo $listar_enderecos['cidade'];?></td>
                <td><?php echo $listar_enderecos['uf'];?></td>
                <td><?php echo $listar_enderecos['ibge'];?></td>
                <td><a href="form_atualiza_enderecos.php?id=<?php echo $listar_enderecos['id'];?>">ATUALIZAR</a></td>
                <td><a href="excluir_enderecos.php?id=<?php echo $listar_enderecos['id'];?>">EXCLUIR</a></td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
        <?php
        $result_pg = "SELECT COUNT(id) AS num_result FROM enderecos";
        $resultado_pg = mysqli_query($conexao, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);
        // echo $row_pg['num_result'];
        $quantidade_pg = ceil($row_pg['num_result'] / $qtd_result_pg);

        $max_links = 2;
        ?>
<div class="paginacao">
  <?php
    
  echo "<a href='listar_enderecos.php?pagina=1'>Primeira </a>";
  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina -1; $pag_ant++){
    if($pag_ant >= 1){
      echo "-";
      echo "<a href='listar_enderecos.php?pagina=$pag_ant'> $pag_ant </a>";
    }
  }
  echo "-";
  echo " $pagina ";
  echo "-";

  for($pag_dep = $pagina + 1; $pag_dep<= $pagina + $max_links; $pag_dep++){
    if($pag_dep <= $quantidade_pg){
      echo "<a href='listar_enderecos.php?pagina=$pag_dep'> $pag_dep </a>";
      echo "-";
    }
  }
  echo "<a href='listar_enderecos.php?pagina=$quantidade_pg'> Ultima</a>";
  ?>
</div>

<?php       
    require("footer.php");
?>
      