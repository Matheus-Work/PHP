<?php       
    require("header.php");
    include("database.php");
    $sql_cat = "SELECT * FROM categorias";
    $resultado_cat = mysqli_query($conexao, $sql_cat);

    $sql_pag = "SELECT * FROM tipos_pagamento";
    $resultado_pag = mysqli_query($conexao, $sql_pag);
    session_start();

    $sql_end = "SELECT * FROM enderecos";
    $resultado_end = mysqli_query($conexao, $sql_end);
?>
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

<form action="cadastra_despesa.php" method="post">
    <div class="form">
        <h4>Passo 4</h4>
        <hr>
        <label  for="valor"><b>Valor: </b></label>
        <input type="number" name="valor" id="valor">
        <br>

        <label for="data_compra"><b>Data Compra: </b></label>
        <input type="datetime" placeholder="Formato: 0000-00-00 00:00:00" name="data_compra" id="data_compra">
        <br><br>

        <label for="descricao_despesa"><b>Descrição: </b></label>
        <input type="text" placeholder="" name="descricao_despesa" id="descricao_despesa" required>
        <br>

        <?php while($cat = mysqli_fetch_assoc($resultado_cat)){  
            $maior_cat=1;
            if($maior_cat < $cat['id'])
                $maior_cat = $cat['id'];
        } ?>

        <?php while($pag = mysqli_fetch_assoc($resultado_pag)){  
            $maior_pag=1;
            if($maior_pag < $pag['id_pag'])
                $maior_pag = $pag['id_pag'];
        } ?>

        <?php while($end = mysqli_fetch_assoc($resultado_end)){  
            $maior_end=1;
            if($maior_end < $end['id'])
                $maior_end = $end['id'];
        } ?>

        <label for="tipo_pagamento_id"><b>Id Pagamento: </b></label>
        <br>
        <select name="tipo_pagamento_id" id="tipo_pagamento_id">
                <option value="<?php echo $maior_pag  ?>"><?php echo $maior_pag  ?></option>
        </select><br>


        <label for="categoria_id"><b>Id Categoria: </b></label>
        <br>
        <select name="categoria_id" id="categoria_id">
                <option value="<?php echo $maior_cat  ?>"><?php echo $maior_cat  ?></option>
        </select><br>

        <label for="endereco_id"><b>Id Endereço: </b></label>
        <br>
        <select name="endereco_id" id="endereco_id">
                <option value="<?php echo $maior_end  ?>"><?php echo $maior_end  ?></option>
        </select><br>

        <button type="submit" class="btn btn-success">Cadastrar Despesa</button>
    </div>
</form>
        
<?php       
    require("footer.php");
?>