<?php 
require_once '../conexao/conexaoBD.php';
$con = new ConexaoBD;
$conexao = $con->ConnectBD();
if(isset($_GET['codCliente'])){
  $cod = $_GET['codCliente'];
  $res = $conexao->query("SELECT * from clientes where cod_cliente = $cod");
  $clienteEdicao = $res->fetchAll()[0];
}
?>

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
      <div class="col-sm-6"><h1><label>Edição do Cliente - <?php echo $clienteEdicao['nome']?></label></h1></div>
      <div class="col-sm-2"></div>
      <div class="col-sm-4"></div>
    </div>

    <div class="col-sm-12">
     <table border="0" class="table">

      <tr>
        <td>Nome do Cliente:</td>
        <td><input value="<?php echo $clienteEdicao['nome'] ?>" type="text" id="txtNome"></td>
      </tr>

      <tr>
        <td>Email:</td>
        <td><input value="<?php echo $clienteEdicao['email'] ?>" type="text" id="txtEmail"></td>
      </tr>

      <tr>
        <td>Cpf:</td>
        <td><input value="<?php echo $clienteEdicao['cpf'] ?>" type="number" id="txtCpf"></td>
      </tr>

      <tr>
        <td>Telefone:</td> 
        <td><input value="<?php echo $clienteEdicao['telefone'] ?>" type="number" id="txtTelefone"></td>
      </tr>
      
      <tr>
        <td>Endereço:</td>
        <td><input value="<?php echo $clienteEdicao['endereco'] ?>" type="text" id="txtEndereco"></td>
      </tr>

      <tr>
        <td>Bairro:</td>
        <td><input value="<?php echo $clienteEdicao['bairro'] ?>" type="text" id="txtBairro"></td>
      </tr>

      <tr>
        <td>Cidade:</td>
        <td><input value="<?php echo $clienteEdicao['cidade'] ?>" type="text" id="txtCidade"></td>
      </tr>
      
      <tr>
        <td>Estado:</td>
        <td>
         <select value="<?php echo $clienteEdicao['estado'] ?>" id="txtEstado" name="estado"> 
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
         Sexo: <input value="<?php echo $clienteEdicao['sexo'] ?>" id="txtSexo" TYPE="RADIO" NAME="OPCAO" VALUE="masculino"> Masculino
         <input value="<?php echo $clienteEdicao['sexo'] ?>" id="txtSexo" TYPE="RADIO" NAME="OPCAO" VALUE="feminino"> Feminino
       </tr>
     </table>
   </table>
 </br>

 <button title='Salvar' class="pull-left btn btn-default" type="button" id="btnSalvar" onclick="cadastrarCliente()">Salvar</button>
</div>        
</body>
</html>

<script>
  var clientes = [];
  var codigo   = <?php echo $clienteEdicao['cod_cliente'];?>
  
  function cadastrarCliente(){

   if($('#txtNome').val() != "" && $('#txtEmail').val() != "" && $('#txtCpf').val() != "" && $('#txtSexo').val() != "" && $('#txtTelefone').val() != "" &&
    $('#txtEndereco').val() != "" &&  $('#txtBairro').val() != "" &&  $('#txtCidade').val() != "" && $('#txtEstado').val() != ""){

    $.ajax({
      url: '../controllers/cliente.controller.php',
      type: 'POST',
      data: {
        cod_cli:  codigo,
        nomeCliente:     $('#txtNome').val(),
        emailCliente:    $('#txtEmail').val(),
        cpfCliente:      $('#txtCpf').val(),
        sexoCliente:     $('#txtSexo').val(),
        telefoneCliente: $('#txtTelefone').val(),
        enderecoCliente: $('#txtEndereco').val(),
        bairroCliente:   $('#txtBairro').val(),
        cidadeCliente:   $('#txtCidade').val(),
        estadoCliente:   $('#txtEstado').val(),
        editarCliente: true
      }, success:function(response){
        if(response != "False"){
          alert('Cliente Editado com Sucesso');
          location.reload();  
          window.location="cliente.php";                  
        }else{
          alert('Erro ao Editar');
        }
      }, error:function(response){
        alert("ERRO AO EDITAR");
      }
    });  
}
}

</script>
