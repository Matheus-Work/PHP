<?php       
    require("header.php");
    require("database.php");
    $sql = "SELECT * FROM categorias";
    $resultado = mysqli_query($conexao, $sql);
    session_start();
?>
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

<style>
    .form{
        margin-left:40%;
        margin-right:30%;
        display:flex;
        /* align-items:center; */
        flex-direction:column;
    }
    .modalform{
        margin:2%;
        padding:5%;
    }
</style><br>

<form action="cadastra_tipo_pagamento.php" method="post">
    <div class="form">
        <h3>Cadastrar</h3>
        <br>
        <h4>Passo 1</h4>
        <hr>
        <label for="tipo"><b>Tipo de Pagamento: </b></label>
        <br>
        <select name="tipo" id="tipo">
            <option value=""></option>
            <option value="dinheiro">Dinheiro</option>
            <option value="debito">Débito</option>
            <option value="credito">Crédito</option>
            <option value="pix">Pix</option>
        </select>
        <br>
        <?php 
        if(isset($_SESSION['mensagem']))
        {
            //armazena em uma variável a mensagem da sessão
            $mensagem = $_SESSION['mensagem'];

            //comando para imprimir a mensagem da sessão 
            echo '<br><p>'. $mensagem . '</p>';

            //Unset retira a mensagem da sessão
            unset($_SESSION['mensagem']);
        }

        ?>
        <button type="submit" class="btn btn-success">Cadastrar Tipo de Pagamento</button>
    </div>
</form>
<br>
<form action="cadastra_categorias.php" method="post">
    <div class="form">
        <h4>Passo 2</h4>
        <hr>
        <label for="nome_categoria"><b>Nome da Categoria: </b></label><br>
        <input type="datetime" name="nome_categoria" id="nome_categoria">
        <br>

        <label for="descricao"><b>Descrição: </b></label><br>
        <input type="text" placeholder="" name="descricao" id="descricao" required>
        <br>
        <?php 
          if(isset($_SESSION['cat_mensagem']))
            {
                //armazena em uma variável a mensagem da sessão
                $mensagem = $_SESSION['cat_mensagem'];

                //comando para imprimir a mensagem da sessão 
                echo '<br><p>'. $mensagem . '</p>';

                //Unset retira a mensagem da sessão
                unset($_SESSION['cat_mensagem']);
            }
        ?>
        <button type="submit" class="btn btn-success">Cadastrar Categoria</button>
        <br><br>
    </div>
</form>

<form method="POST" action="cadastra_endereco.php">
    <div class="form">
        <h4>Passo 3</h4>
        <hr>
        <label><b>Cep:</b><br>
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
            onblur="pesquisacep(this.value);" /></label><br />
        <label><b>Rua:</b>
        <input name="rua" type="text" id="rua" size="60" /></label><br />
        <label><b>Número:</b>
        <input name="numero" type="text" id="numero" size="60" /></label><br />
        <label><b>Bairro:</b><br>
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label><b>Cidade:</b><br>
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label><b>Estado:</b><br>
        <input name="uf" type="text" id="uf" size="2" /></label><br />
        <label><b>IBGE:</b><br>
        <input name="ibge" type="text" id="ibge" size="8" /></label><br />

        <button type="submit" class="btn btn-success">Cadastrar Endereço</button>
    </div>
</form>

<?php       
  require("footer.php");
?>