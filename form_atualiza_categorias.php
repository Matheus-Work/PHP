<?php       
    include("database.php");

    $id= $_GET["id"];

    $consulta_por_id = "SELECT * FROM `categorias` WHERE id ='$id'";

    $resultado_por_id = mysqli_query($conexao, $consulta_por_id);

    $atualiza_categoria = mysqli_fetch_assoc($resultado_por_id);

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
  .letra{
      justify-content:center;
      text-align: center;
  }
  .form{
      margin-left:40%;
      margin-right:30%;
      display:flex;
      /* align-items:center; */
      flex-direction:column;
  }
</style>

<br><br>

<form action="atualiza_categorias.php" method="post">
  <div class="form">
    <h3 class="letra">Atualizar Categoria</h3>
    <hr>

    <input type="hidden" name="id" value="<?php echo $atualiza_categoria['id'];?>">

    <label for="nome_categoria">Nome: </label>
    <input type="text" name="nome_categoria" id="nome_categoria" value="<?php echo $atualiza_categoria['nome_categoria'];?>"><br><br>

    <label for="descricao">Descrição: </label>
    <input type="text" name="descricao" id="descricao" value="<?php echo $atualiza_categoria['descricao'];?>"><br><br>

    <button type="submit" class="registerbtn">Atualizar Categoria</button>
  </div>
</form>

<?php       
    require("footer.php");
?>

     