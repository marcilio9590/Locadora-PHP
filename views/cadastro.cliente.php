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
  



  
  
  
  <INPUT id="sexo" TYPE="RADIO" NAME="OPCAO" VALUE="masculino"> Masculino
  <INPUT id="sexo" TYPE="RADIO" NAME="OPCAO" VALUE="feminino"> Femenino 


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
<input id="cadastrar" onlick="cadastrarCliente()" type="submit" value="Cadastrar">
<input id="limparcliente" type="reset" value="Limpar">
</form>
                    </div>
                </div>


        </div>
    </body>
</html>

<script>
    var filmes = [];

    function cadastrarcliente(){
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

                
            },success:function(response){
                if(response.trim() == "1"){
                    alert('Cliente Cadastrado');
                    location.reload();                   
                }else{
                    alert('Erro ao cadastrar');
                }
            }, error:function(response){
                alert("ERRO AO CADASTRAR");
            };
            }
        });  
    }

    
</script>