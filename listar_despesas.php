<?php       
  require("database.php");
  require("header.php");

  $sql = "SELECT * FROM despesas";
  $resultado = mysqli_query($conexao, $sql);
  session_start();

  $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);
  $pagina = (!empty($pagina_atual)) ? $pagina_atual:1;

  $qtd_result_pg = 6;

  $inicio = ($qtd_result_pg * $pagina) - $qtd_result_pg;

  $sql = "SELECT * FROM despesas LIMIT $inicio, $qtd_result_pg";
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
  <h3>Lista de Despesas</h3>
  <hr>
  <div class="botaopdf">
    <button type="button" class="btn btn-success" style="margin-right: 10px;">
    <a class="corpdf" href="gerar_excel_despesas.php">Gerar Excel</a></button>
    <br>
    <button type="button" class="btn btn-danger"><a class="corpdf" href="gerar_pdf_despesas.php">Gerar PDF</a></button>
  </div>
  <table class="table table-striped">
    <thead>        
      <tr>
        <th>Id:</th>
        <th>Valor: </th>
        <th>Data Compra: </th>
        <th>Descrição: </th>
        <th>Id Tipo Pagamento: </th>
        <th>Id Categoria: </th>
        <th>Id Endereço: </th>
        <th>Atualizar: </th>
        <th>Excluir: </th>
      </tr>
    </thead>
    <tbody>
        <?php while($listar_despesas = mysqli_fetch_assoc($resultado)){  ?>
            <tr>
              <td><?php echo $listar_despesas['id'];?></td>
              <td><?php echo $listar_despesas['valor'];?></td>
              <td><?php echo $listar_despesas['data_compra'];?></td>
              <td><?php echo $listar_despesas['descricao_despesa'];?></td>
              <td>
                <?php 
                if(!empty($listar_despesas['tipo_pagamento_id'])) echo $listar_despesas['tipo_pagamento_id'];?></td>
              <td>
                <?php
                if(!empty($listar_despesas['categoria_id'])) echo $listar_despesas['categoria_id'];?></td>
                <td><?php
                if(!empty($listar_despesas['endereco_id'])) echo $listar_despesas['endereco_id'];?></td>
              <td><a href="form_atualiza_despesas.php?id=<?php echo $listar_despesas['id'];?>">ATUALIZAR</a></td>
              <td><a href="excluir_despesas.php?id=<?php echo $listar_despesas['id'];?>">EXCLUIR</a></td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
        <?php
        $result_pg = "SELECT COUNT(id) AS num_result FROM despesas";
        $resultado_pg = mysqli_query($conexao, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);
        // echo $row_pg['num_result'];
        $quantidade_pg = ceil($row_pg['num_result'] / $qtd_result_pg);

        $max_links = 2;
        ?>
<div class="paginacao">
  <?php
  echo "<a href='listar_despesas.php?pagina=1'>Primeira </a>";
  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina -1; $pag_ant++){
    if($pag_ant >= 1){
      echo "-";
      echo "<a href='listar_despesas.php?pagina=$pag_ant'> $pag_ant </a>";
    }
  }
  echo "-";
  echo " $pagina ";
  echo "-";

  for($pag_dep = $pagina + 1; $pag_dep<= $pagina + $max_links; $pag_dep++){
    if($pag_dep <= $quantidade_pg){
      echo "<a href='listar_despesas.php?pagina=$pag_dep'> $pag_dep </a>";
      echo "-";
    }
  }
  echo "<a href='listar_despesas.php?pagina=$quantidade_pg'> Ultima</a>";
  ?>
</div>

<?php       
    require("footer.php");
?>
      