<?php       
  include("database.php");

  $id = $_GET["id"];

  $consulta_por_id = "SELECT * FROM `tipos_pagamento` WHERE id_pag ='$id'";

  $resultado_por_id = mysqli_query($conexao, $consulta_por_id);

  $atualiza_tipo_pagamento = mysqli_fetch_assoc($resultado_por_id);

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

<form action="atualiza_tipo_pagamento.php" method="post">
  <div class="form">
    <h3 class="letra">Atualizar Tipo de Pagamento</h3>

    <hr>

    <br><br>

    <input type="hidden" name="id_pag" value="<?php echo $atualiza_tipo_pagamento['id_pag'];?>">

    <label for="tipo">Tipos de Pagamento: </label><br><br>
    <select name="tipo" id="tipo">
      <option value="<?php echo $atualiza_tipo_pagamento['tipo']; ?>">
      <?php echo $atualiza_tipo_pagamento['tipo']; ?></option>
      <option value="dinheiro">Dinheiro</option>
      <option value="debito">Débito</option>
      <option value="credito">Crédito</option>
      <option value="pix">Pix</option>
    </select><br><br><br><br>

    <button type="submit" class="registerbtn">Atualizar Tipo de Pagamento</button>
  </div>
</form>
<br><br><br>
<?php       
    require("footer.php");
?>

     