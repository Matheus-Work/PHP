<?php       
  include("database.php");

  $id= $_GET["id"];

  $consulta_por_id = "SELECT * FROM `enderecos` WHERE id ='$id'";

  $resultado_por_id = mysqli_query($conexao, $consulta_por_id);

  $atualiza_enderecos = mysqli_fetch_assoc($resultado_por_id);

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
  .form{
    margin-left:40%;
    margin-right:30%;
    display:flex;
    flex-direction:column;
  }
</style>

<br><br>

<script>
    function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('rua').value=("");
      document.getElementById('bairro').value=("");
      document.getElementById('cidade').value=("");
      document.getElementById('uf').value=("");
      document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
          //Atualiza os campos com os valores.
          document.getElementById('rua').value=(conteudo.logradouro);
          document.getElementById('bairro').value=(conteudo.bairro);
          document.getElementById('cidade').value=(conteudo.localidade);
          document.getElementById('uf').value=(conteudo.uf);
          document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
          //CEP não Encontrado.
          limpa_formulário_cep();
          alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                document.getElementById('ibge').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
</script>


<form action="atualiza_endereco.php" method="post">
  <div class="form">
    <h3 class="letra">Atualizar Endereço</h3>

    <hr>

    <input type="hidden" name="id" value="<?php echo $atualiza_enderecos['id'];?>">

    <label><b>Cep:</b><br>
    <input name="cep" type="text" id="cep" 
    value="<?php echo $atualiza_enderecos['cep'];?>" 
    size="10" maxlength="9"
        onblur="pesquisacep(this.value);" /></label><br />

    <label><b>Rua:</b>
    <input name="rua" type="text" id="rua"
    value="<?php echo $atualiza_enderecos['rua'];?>"
    size="60" /></label><br />

    <label><b>Número:</b>
    <input name="numero" type="text" id="numero" 
    value="<?php echo $atualiza_enderecos['numero'];?>"
    size="60" /></label><br />

    <label><b>Bairro:</b><br>
    <input name="bairro" type="text" id="bairro" 
    value="<?php echo $atualiza_enderecos['bairro'];?>"
    size="40" /></label><br />

    <label><b>Cidade:</b><br>
    <input name="cidade" type="text" id="cidade" 
    value="<?php echo $atualiza_enderecos['cidade'];?>"
    size="40" /></label><br />

    <label><b>Estado:</b><br>
    <input name="uf" type="text" id="uf" 
    value="<?php echo $atualiza_enderecos['uf'];?>"
    size="2" /></label><br />

    <label><b>IBGE:</b><br>
    <input name="ibge" type="text" id="ibge" 
    value="<?php echo $atualiza_enderecos['ibge'];?>"
    size="8" /></label><br />

    <button type="submit" class="btn btn-success">Atualizar Endereço</button>
  </div>
</form>
<?php       
    require("footer.php");
?>

     