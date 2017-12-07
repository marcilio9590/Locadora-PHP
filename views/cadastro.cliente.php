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
      <div class="col-sm-4"><h1><label>Novo cliente</label></h1></div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4"></div>
    </div>

    <div class="col-sm-12">
     <table border="0" class="table">

      <tr>
        <td>Nome do Cliente:</td>
        <td><input type="text" id="txtNome"></td>
      </tr>

      <tr>
        <td>Email:</td>
        <td><input type="text" id="txtEmail"></td>
      </tr>

      <tr>
        <td>Cpf:</td>
        <td><input type="text" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="txtCpf"></td>
      </tr>

      <tr>
        <td>Telefone:</td> 
        <td><input type="number" maxlength="11" id="txtTelefone"></td>
      </tr>
      
      <tr>
        <td>Endereço:</td>
        <td><input type="text" id="txtEndereco"></td>
      </tr>

      <tr>
        <td>Bairro:</td>
        <td><input type="text" id="txtBairro"></td>
      </tr>

      <tr>
        <td>Cidade:</td>
        <td><input type="text" id="txtCidade"></td>
      </tr>
      
      <tr>
        <td>Estado:</td>
        <td>
         <select id="txtEstado" name="estado"> 
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
           <option value="pe" selected>Pernambuco</option> 
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
         </select></td>
       </tr>

       <table>
        <tr>
         Sexo: <input id="txtSexo" TYPE="RADIO" NAME="OPCAO" VALUE="masculino"> Masculino
         <input id="txtSexo" TYPE="RADIO" NAME="OPCAO" VALUE="feminino"> Feminino
       </tr>
     </table>
   </table>
   <br>

   <button title='Cadastrar' class="pull-left btn btn-default" type="button" id="btnCadastrar" onclick="cadastrarCliente()">Cadastrar</button>
 </div>        
</body>
</html>


<script>

  var clientes = [];

  function cadastrarCliente(){

   if($('#txtNome').val() != "" &&
     $('#txtEmail').val()!= ""  &&
     $('#txtCpf').val() != "" &&
     $('#txtSexo').val() != "" &&
     $('#txtTelefone').val() != "" &&                 
     $('#txtEndereco').val() != "" &&
     $('#txtBairro').val() != "" &&
     $('#txtCidade').val() != "" &&
     $('#txtEstado').val() != ""){
     $.ajax({
      url: '../controllers/cliente.controller.php',
      type: 'POST',
      data: {
        nomeCliente:     $('#txtNome').val(),
        emailCliente:    $('#txtEmail').val(),
        cpfCliente:      $('#txtCpf').val(),
        sexo:            $('#txtSexo').val(),
        telefoneCliente: $('#txtTelefone').val(),                 
        enderecoCliente: $('#txtEndereco').val(),
        bairroCliente:   $('#txtBairro').val(),
        cidadeCliente:   $('#txtCidade').val(),
        estadoCliente:   $('#txtEstado').val(),
        salvarDados: true
      },success:function(response){
        if(response.trim() == "1"){
         alert('Cliente Cadastrado');
         window.location="cliente.php";                   
       }else{
        alert('Erro ao cadastrar');
      }
    }, error:function(response){
      alert("ERRO AO CADASTRAR");
    }
  }); 
 }else{
  alert("Preencha todos os campos");
}


}

</script>