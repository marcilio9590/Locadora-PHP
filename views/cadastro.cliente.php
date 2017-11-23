<?php require_once('../controllers/cadastro.locacoes.controller.php'); ?>

<html>
    <head>
        <script src="../resources/bootstrap/js/jquery.min.js"></script>
        <script src="../resources/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css" />
        <title>Locadora de filmes 1.0</title>
    </head>
    <body>
        <div>
            <?php require_once('menu.php'); ?>
        </div>
        <div class="container-fluid"> 
                <div class="row">
                    <div class="col-sm-4"><h1><label>Novo cliente</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                    <div class="col-sm-12">
                    <form action="Script_do_Formulario.php" method="post">

<!-- DADOS PESSOAIS-->
<fieldset>
 <legend>Dados Pessoais</legend>
 <table class="table"cellspacing="6">
  <tr>
   <td>
    <label for="nome">Nome: </label>
   </td>
   <td align="left">
    <input id="nomecliente" type="text" name="nomecliente">
   </td>
   <td>
    <label for="telefone">Telefone: </label>
   </td>
   <td align="left">
   <input id="ddd" type="text" name="ddd" size="1" maxlength="3">-<input id="telefonecliente" type="text" name="telefone">
   </td>
  </tr>
  
  <table class="table" cellspacing="6">
  <tr>
   <td>
    <label for="email">E-mail: </label>
   </td>
   <td align="left">
    <input id="emailcliente" type="text" name="email">
   </td>
  </tr>
  
  
  
  <tr>
   <td>
    <label>Nascimento: </label>
   </td>
   <td align="left">
    <input id="diacliente" type="text" name="dia" size="2" maxlength="2" value="dd"> 
   <input id="mescliente" type="text" name="mes" size="2" maxlength="2" value="mm"> 
   <input id="anocliente" type="text" name="ano" size="4" maxlength="4" value="aaaa">
   </td>
  </tr>
  <tr>
   <td>
    <label for="rg">RG: </label>
   </td>
   <td align="left">
    <input id="rgcliente" type="text" name="rg" size="13" maxlength="13"> 
   </td>
  </tr>
  
  
<INPUT id="sexomasculino" TYPE="RADIO" NAME="OPCAO" VALUE="op1"> Masculino
<INPUT id="sexofemenino" TYPE="RADIO" NAME="OPCAO" VALUE="op2"> Femenino 


  <tr>
   <td>
    <label>CPF:</label>
   </td>
   <td align="left">
    <input id="cpfcliente" type="text" name="cpf" size="9" maxlength="9"> - <input id="cpf2cliente" type="text" name="cpf2" size="2" maxlength="2">
   </td>
  </tr>
 </table>
</fieldset>

<br />
<!-- ENDEREÇO -->
<fieldset>
 <legend>Dados de Endereço</legend>
 <table class="table" cellspacing="10">

  <tr>
   <td>
    <label for="endereço">Rua:</label>
   </td>
   <td align="left">
    <input id="endereçocliente" type="text" name="endereço">
   </td>
   <td>
    <label for="numero">Numero:</label>
   </td>
   <td align="left">
    <input id="numerocliente" type="text" name="numero" size="4">
   </td>
  </tr>
  <tr>
   <td>
    <label for="bairro">Bairro: </label>
   </td>
   <td align="left">
    <input id="bairrocliente" type="text" name="bairro">
   </td>
  </tr>
  <tr>
   <td>
    <label for="estado">Estado:</label>
   </td>
   <td align="left">
    <select name="estado"> 
    <option value="ac">Acre</option> 
    <option value="al">Alagoas</option> 
    <option value="am">Amazonas</option> 
    <option value="ap">Amapá</option> 
    <option value="ba">Bahia</option> 
    <option value="ce">Ceará</option> 
    <option value="df">Distrito Federal</option> 
    <option value="es">Espírito Santo</option> 
    <option value="go">Goiás</option> 
    <option value="ma">Maranhão</option> 
    <option value="mt">Mato Grosso</option> 
    <option value="ms">Mato Grosso do Sul</option> 
    <option value="mg">Minas Gerais</option> 
    <option value="pa">Pará</option> 
    <option value="pb">Paraíba</option> 
    <option value="pr">Paraná</option> 
    <option value="pe">Pernambuco</option> 
    <option value="pi">Piauí</option> 
    <option value="rj">Rio de Janeiro</option> 
    <option value="rn">Rio Grande do Norte</option> 
    <option value="ro">Rondônia</option> 
    <option value="rs">Rio Grande do Sul</option> 
    <option value="rr">Roraima</option> 
    <option value="sc">Santa Catarina</option> 
    <option value="se">Sergipe</option> 
    <option value="sp">São Paulo</option> 
    <option value="to">Tocantins</option> 
   </select>
   </td>
  </tr>
  <tr>
   <td>
    <label for="cidade">Cidade: </label>
   </td>
   <td align="left">
    <input id="cidadecliente" type="text" name="cidade">
   </td>
  </tr>
  
 </table>
</fieldset>
<br />


<br />
<input id="cadastrar" type="submit" value="Cadastrar">
<input id="limparcliente" type="reset" value="Limpar">
</form>
                    </div>
                </div>


        </div>
    </body>
</html>

<script>
    var filmes = [];

    function cadastrarCliente(){
        $.ajax({
            url: '../controllers/cliente.controller.php',
            type: 'POST',
            data: {
                nomecliente: $('#nomecliente').val(),
                ddd: $('#ddd'),
                telefonecliente: $('#telefonecliente'),
                emailcliente: $('#emailcliente'),
                diacliente: $('#diacliente'),
                mescliente: $('#mescliente'),
                anocliente: $('#anocliente'),
                rgcliente: $('#rgcliente'),
                sexomasculino: $('#sexomasculino'),
                sexofemenino: $('#sexofemenino'),
                cpfcliente: $('#cpfcliente'),
                endereçocliente: $('#endereçocliente'),
                numerocliente: $('#numerocliente'),
                bairrocliente: $('#bairrocliente'),
                cidadecliente: $('#cidadecliente'),
                cadastrar: $('#cadastrar'),
                limparcliente: $('#limparcliente')


                
            },success:function(data){
                if(data !== "false"){
                    alert('Cliente cadastrado com sucesso!');                       
                }else{
                    alert('Erro ao cadastrar cliente!');
                }
            },error:function(){
                alert("Erro ao cadastrar cliente!");
            };
            }
        });  
    }

    
</script>