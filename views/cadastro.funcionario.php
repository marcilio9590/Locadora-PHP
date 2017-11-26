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
                                    <td>Código do Funcionário:</td>
                                <td><input type="number" id="txtCodFuncionario"></td>
                            </tr>
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
                                <td><input type="datetime" id="txtData" <?php echo date("d/m/Y"); ?></td>
                            </tr>

                             <tr>
                                    <td>Telefone:</td>
                                <td><input type="tel" id="txtTelefone"></td>
                            </tr>
                        </table>
                        <button class="btn btn-default" type="button" onclick="salvarDados()">Salvar Dados</button>
                        <br>
                    </div>
                   
               </div>
        </div>
    </body>
</html>

<script>
    
     function salvarDados(){
        $.ajax({
            url: '../controllers/funcionario.controller.php',
            type: 'POST',
            data: {
                cod_Funcionario:  $('#txtCodFuncionario').val(),
                nomeFuncionario: $('#txtNome').val(),
                ruaFuncionario:  $('#txtRua').val(),
                cepFuncionario:  $('#txtCep').val(),
                bairroFuncionario : $('#txtBairro').val(),
                cidadeFuncionario: $('#txtCidade').val(),
                cpfFuncionario: $('#txtCpf').val(),
                rgFuncionario: $('#txtRg').val(),
                sexoFuncionario: $('#txtSexo').val(),
                data_nascimentoFuncionario: $('#txtData').val(),
                telefoneFuncionario: $('#txtTelefone').val(),
                salvarDados: true
            }, success:function(response){
                if(response.trim() == "1"){
                    alert('Funcionário Cadastrado');
                    location.reload();                   
                }else{
                    alert('Erro ao cadastrar');
                }
            }, error:function(response){
                alert("ERRO AO CADASTRAR");
            }
        });  
    }


     function editarFuncionario(cod){
        $.ajax({
            url: '../controllers/funcionario.controller.php',
            type: 'POST',
            data: {
                cod_Funcionario: cod_Funcionario
            },success:function(data){
                if(data == true){
                    alert('#!');
                    location.reload();  
                    console.log(data);                
                }else{
                    alert('#');
                }
            },error:function(){
                alert("#");
            }
        });  
    }

</script>

