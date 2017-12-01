<?php require_once('../controllers/cliente.controller.php'); ?>

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
                    <div class="col-sm-4"><h1><label>Editar cliente- <?php echo $cliente['nome']?></label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                    <div class="col-sm-12">

<!-- DADOS PESSOAIS-->
<fieldset>
 <legend>Dados Pessoais</legend>
 <table class="table"cellspacing="6">
  <tr>
   <td>
    <label for="nome">Nome: </label>
   </td>
   <td align="left">
    <input id="nomecliente" value="<?php echo $cliente['nome'] ?>" type="text" name="nomecliente">
   </td>
   <td>
    <label for="telefone">Telefone: </label>
   </td>
   <td align="left">
   <input id="telefonecliente" value="<?php echo $cliente['telefone'] ?>" type="text" name="telefone">
   </td>
  </tr>
  
  <table class="table" cellspacing="6">
  <tr>
   <td>
    <label for="email">E-mail: </label>
   </td>
   <td align="left">
    <input id="emailcliente" value="<?php echo $cliente['email'] ?>" type="text" name="email">
   </td>
  </tr>

  <!-- IF ternario para definir o sexo -->
  <INPUT id="sexo" <?php echo ($cliente['sexo']== 'Masculino') ? 'checked':'' ?> TYPE="RADIO" NAME="OPCAO" VALUE="masculino"> Masculino
  <INPUT id="sexo" <?php echo ($cliente['sexo']== 'Feminino') ? 'checked':'' ?> TYPE="RADIO" NAME="OPCAO" VALUE="feminino"> Femenino 


  <tr>
   <td>
    <label>CPF:</label>
   </td>
   <td align="left">
    <input id="cpfcliente" value="<?php echo $cliente['cpf'] ?>" type="text" name="cpf" size="9" maxlength="9"> 
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
    <label for="endereco">Rua:</label>
   </td>
   <td align="left">
    <input id="enderecocliente" type="text" name="endereco">
   </td>
   <td>

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
    <select id="estado" name="estado"> 
    <option <?php echo ($cliente['estado']== 'ac') ? 'seleted':'' ?> value="ac">Acre</option> 
    <option <?php echo ($cliente['estado']== 'al') ? 'seleted':'' ?> value="al">Alagoas</option> 
    <option <?php echo ($cliente['estado']== 'am') ? 'seleted':'' ?> value="am">Amazonas</option> 
    <option <?php echo ($cliente['estado']== 'ap') ? 'seleted':'' ?> value="ap">Amapá</option> 
    <option <?php echo ($cliente['estado']== 'ba') ? 'seleted':'' ?> value="ba">Bahia</option> 
    <option <?php echo ($cliente['estado']== 'ce') ? 'seleted':'' ?> value="ce">Ceará</option> 
    <option <?php echo ($cliente['estado']== 'df') ? 'seleted':'' ?> value="df">Distrito Federal</option> 
    <option <?php echo ($cliente['estado']== 'es') ? 'seleted':'' ?> value="es">Espírito Santo</option> 
    <option <?php echo ($cliente['estado']== 'go') ? 'seleted':'' ?> value="go">Goiás</option> 
    <option <?php echo ($cliente['estado']== 'ma') ? 'seleted':'' ?> value="ma">Maranhão</option> 
    <option <?php echo ($cliente['estado']== 'mt') ? 'seleted':'' ?> value="mt">Mato Grosso</option> 
    <option <?php echo ($cliente['estado']== 'ms') ? 'seleted':'' ?> value="ms">Mato Grosso do Sul</option> 
    <option <?php echo ($cliente['estado']== 'mg') ? 'seleted':'' ?> value="mg">Minas Gerais</option> 
    <option <?php echo ($cliente['estado']== 'pa') ? 'seleted':'' ?> value="pa">Pará</option> 
    <option <?php echo ($cliente['estado']== 'pb') ? 'seleted':'' ?> value="pb">Paraíba</option> 
    <option <?php echo ($cliente['estado']== 'pr') ? 'seleted':'' ?> value="pr">Paraná</option> 
    <option <?php echo ($cliente['estado']== 'pe') ? 'seleted':'' ?> value="pe">Pernambuco</option> 
    <option <?php echo ($cliente['estado']== 'pi') ? 'seleted':'' ?> value="pi">Piauí</option> 
    <option <?php echo ($cliente['estado']== 'rj') ? 'seleted':'' ?> value="rj">Rio de Janeiro</option> 
    <option <?php echo ($cliente['estado']== 'rn') ? 'seleted':'' ?> value="rn">Rio Grande do Norte</option> 
    <option <?php echo ($cliente['estado']== 'ro') ? 'seleted':'' ?> value="ro">Rondônia</option> 
    <option <?php echo ($cliente['estado']== 'rs') ? 'seleted':'' ?> value="rs">Rio Grande do Sul</option> 
    <option <?php echo ($cliente['estado']== 'rr') ? 'seleted':'' ?> value="rr">Roraima</option> 
    <option <?php echo ($cliente['estado']== 'sc') ? 'seleted':'' ?> value="sc">Santa Catarina</option> 
    <option <?php echo ($cliente['estado']== 'se') ? 'seleted':'' ?> value="se">Sergipe</option> 
    <option <?php echo ($cliente['estado']== 'sp') ? 'seleted':'' ?> value="sp">São Paulo</option> 
    <option <?php echo ($cliente['estado']== 'to') ? 'seleted':'' ?> value="to">Tocantins</option> 
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
<button class="pull-left btn btn-default" type="button" id="btnCadastrar" onclick="editarcliente()">Editar</button>
<input class="btn btn-default" id="limparcliente" type="reset" value="Limpar">
                    </div>
                </div>


        </div>
    </body>
</html>

<script>
    var filmes = [];

    function editarcliente(){
      if($('#nomecliente').val() != "" && $('#ddd').val() != "" && $('#telefonecliente').val() !="" && $('#emailcliente').val() !="" &&  $('#sexo').val() !="" && $('#cpfcliente').val() !="" && $('#enderecocliente').val() !="" && $('#bairrocliente').val() !="" && $('#cidadecliente').val() !="" && $('#estado').val() !="" ){
        $.ajax({
            url: '../controllers/cliente.controller.php',
            type: 'POST',
            data: {
                nomecliente: $('#nomecliente').val(),
                ddd: $('#ddd').val(),
                telefonecliente: $('#telefonecliente').val(),
                emailcliente: $('#emailcliente').val(),                
                sexo: $('#sexo').val(),
                cpfcliente: $('#cpfcliente').val(),
                enderecocliente: $('#enderecocliente').val(),
                bairrocliente: $('#bairrocliente').val(),
                cidadecliente: $('#cidadecliente').val(),
                        estadocliente: $('#estado').val(),
                        salvardados: true
                    }, success:function(response){
                    if(response != "False"){
                        alert("Cliente Editado com Sucesso");
                        window.location="cliente.php";                   
                    }else{
                        alert('Erro ao Editar');
                    }
                }, error:function(response){
                    alert("ERRO AO EDITAR");
                }
            });  
        } else {
            alert('Preencha todos os campos.')
        }
    }
</script>