<?php 
require_once '../conexao/conexaoBD.php';
    $con = new ConexaoBD;
    $conexao = $con->ConnectBD();
    if(isset($_GET['codFuncionario'])){
        $cod = $_GET['codFuncionario'];
        $res = $conexao->query("SELECT * from funcionarios where cod_funcionario = $cod");
        $funcionario = $res->fetchAll()[0];
    }

?>

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
                    <div class="col-sm-6"><h2><label>Edição do Funcionário - <?php echo $funcionario['nome']?></label></h2></div>
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
                                <td><input value="<?php echo $funcionario['nome'] ?>" type="text" id="txtNome"></td>
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
                                <td><input type="number" id="txtCpf"></td>
                            </tr>

                             <tr>
                                    <td>Rg:</td>
                                <td><input type="number" id="txtRg"></td>
                            </tr>

                            <tr>
                                    <td>Sexo:</td>
                                <td><input type="text" id="txtSexo"></td>
                            </tr>

                             <tr>
                                    <td>Data Admissão:</td>
                                <td><input type="datetime" id="txtDataAdmissao" style="text-align:center;"value="<?php echo date("d/m/Y"); ?>"></td>
                            </tr>

                             <tr>
                                    <td>Telefone:</td>
                                <td><input type="number" id="txtTelefone"></td>
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
    var codigo = <?php echo $funcionario['cod_funcionario'];?>
    
     function salvarDados(){
        $.ajax({
            url: '../controllers/funcionario.controller.php',
            type: 'POST',
            data: {
                codigoFuncionario:  codigo,
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
                editarDados: true
            }, success:function(response){
                if(response.trim() == "1"){
                    alert('Funcionário Cadastrado');
                    location.reload();                   
                }else{
                    alert('Erro ao Cadastrar');
                }
            }, error:function(response){
                alert("ERRO AO CADASTRAR");
            }
        });  
    }

</script>

