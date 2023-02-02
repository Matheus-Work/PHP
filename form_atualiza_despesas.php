<?php       
    include("database.php");

    $id= $_GET["id"];

    $consulta_por_id = "SELECT * FROM `despesas` WHERE id ='$id'";

    $resultado_por_id = mysqli_query($conexao, $consulta_por_id);

    $atualiza_despesas = mysqli_fetch_assoc($resultado_por_id);

    session_start();
    
    $sql_cat = "SELECT * FROM categorias";
    $resultado = mysqli_query($conexao, $sql_cat);
     while($cat = mysqli_fetch_assoc($resultado)){  
        if($cat['id'] == $atualiza_despesas['categoria_id'])
        {
            $id_categoria = $cat['id'];
            $nome_categoria = $cat['nome_categoria'];
            $descricao_categoria = $cat['descricao'];
        }
    } 

    $sql_pag = "SELECT * FROM tipos_pagamento";
    $resultado_pag = mysqli_query($conexao, $sql_pag);
     while($pag = mysqli_fetch_assoc($resultado_pag)){  
        if($pag['id_pag'] == $atualiza_despesas['tipo_pagamento_id'])
        {
            $id_tipo_pagamento = $pag['id_pag'];
            $tipo_pagamento = $pag['tipo'];
        }
    } 

    require("header.php");
?>

<style>
  * {box-sizing: border-box}

  /* Add padding to containers */
  .container {
    padding: 16px;
  }

  /* Full-width input fields */
  input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
  }

  input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Overwrite default styles of hr */
  hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
  }

  /* Set a style for the submit/register button */
  .registerbtn {
    background-color: #04AA6D;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  .registerbtn:hover {
    opacity:1;
  }

  /* Add a blue text color to links */
  a {
    color: dodgerblue;
  }

  /* Set a grey background color and center the text of the "sign in" section */
  .signin {
    background-color: #f1f1f1;
    text-align: center;
  }
  .imglogo2{
    width:10%;
    right:47%;
    top: 10%;
    position: absolute;
  }
  .letra{
    justify-content:flex-end;
    text-align: center;
  }
  form{
    margin-left:40%;
    margin-right:30%;
    display:flex;
    flex-direction:column;
  }
</style>
<br><br>
<form action="atualizar_despesas.php" method="post">
  <div class="form">
    <h3 class="letra">Atualizar Despesas</h3>
    <hr>
    <input type="hidden" name="id" value="<?php echo $atualiza_despesas['id'];?>">

    <label for="valor">Valor: </label><br>
    <input type="number" name="valor" id="valor" value="<?php echo $atualiza_despesas['valor'];?>"><br><br>

    <label for="data_compra">Data Compra:</label>
    <input type="text" name="data_compra" id="data_compra" value="<?php echo $atualiza_despesas['data_compra'];?>"><br><br>

    <label for="descricao_despesa">Descrição:</label>
    <input type="text" name="descricao_despesa" id="descricao_despesa" value="<?php echo $atualiza_despesas['descricao_despesa'];?>"><br><br>


    <button type="submit" class="registerbtn">Atualizar Despesa</button>
  </div>
</form>

<?php 
  require("footer.php");
?>