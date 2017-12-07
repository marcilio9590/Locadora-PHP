<?php require_once('../controllers/funcionario.controller.php'); ?>

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
            <div class="col-sm-6"><h1><label>Cadastro de novos Funcionários</label></h1></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-4"></div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <table border="0" class="table">

                    <tr>
                        <td>Nome do funcionário:</td>
                        <td><input type="text" id="txtNome"></td>
                    </tr>
                    <tr>
                        <td>Rua:</td> 
                        <td><input type="text" id="txtRua"></td>
                    </tr>
                    
                    <tr>
                        <td>Cep:</td>
                        <td><input type="number" id="txtCep"></td>
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
                        <td>Cpf:</td>
                        <td><input type="text" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="txtCpf"></td>
                    </tr>

                    <tr>
                        <td>Rg:</td>
                        <td><input type="text" maxlength="7" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="txtRg"></td>
                    </tr>

                    <tr>
                        <td>Sexo:</td>
                        <td><input type="text" id="txtSexo"></td>
                    </tr>

                    <tr>
                        <td>Data Admissão:</td>
                        <td><input maxlength="10" oninput="this.value=this.value.replace(/[^0-9/]/g,'');" type="datetime" id="txtDataAdmissao" style="text-align:center;"value="<?php echo date("d/m/Y"); ?>"></td>
                    </tr>

                    <tr>
                        <td>Telefone:</td>
                        <td><input type="number" maxlength="11" id="txtTelefone"></td>
                    </tr>
                </table>
                <button title='Salvar' class="pull-left btn btn-default" type="button" id="btnSalvar" onclick="salvarDados()">Salvar</button>
                <br>
            </div>
            
        </div>
    </div>
</body>
</html>

<script>
    var funcionarios = [];
    
    function salvarDados(){
     
        if($('#txtNome').val() != "" &&
         $('#txtRua').val() != "" &&
         $('#txtCep').val() != "" &&
         $('#txtBairro').val() != "" &&
         $('#txtCidade').val() != "" &&
         $('#txtCpf').val() != "" &&
         $('#txtRg').val() != ""  &&
         $('#txtSexo').val() != "" &&
         $('#txtDataAdmissao').val() &&
         $('#txtTelefone').val() != ""){

         $.ajax({
            url: '../controllers/funcionario.controller.php',
            type: 'POST',
            data: {
                nomefuncionarios:   $('#txtNome').val(),
                ruafuncionarios:    $('#txtRua').val(),
                cepfuncionarios:    $('#txtCep').val(),
                bairrofuncionarios: $('#txtBairro').val(),
                cidadefuncionarios: $('#txtCidade').val(),
                cpffuncionarios:    $('#txtCpf').val(),
                rgfuncionarios:     $('#txtRg').val(),
                sexofuncionarios:   $('#txtSexo').val(),
                data_admissaos:     $('#txtDataAdmissao').val(),
                telefonefuncionarios: $('#txtTelefone').val(),
                cadastrarDados: true
            }, success:function(response){
                if(response.trim() == "1"){
                    alert('Funcionário Cadastrado');
                    window.location="funcionario.php";                    
                }else{
                    alert('Erro ao cadastrar');
                }
            }, error:function(response){
                alert("ERRO AO CADASTRAR");
            }
        });
 }else{
    alert("Preencha todos os campos.");
}


}
</script>

