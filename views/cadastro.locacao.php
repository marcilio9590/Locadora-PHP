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
                    <div class="col-sm-4"><h1><label>Nova Locação</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                <br>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">
                    
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Cod. Cliente:</label>
                                <div class="col-sm-9">
                                    <input type="text" style="width:350px;" class="pull-left form-control" id="codCliente"/>
                                    <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                                    type="button" onclick="buscarCliente()">Pesquisar</button>
                                </div>
                            </div>

                            <div style="display:none;" id="divNomeCliente" class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Nome Cliente:</label>
                                <div class="col-sm-9">
                                    <input style="width:350px;" type="text" disabled="true" class="form-control" id="nomeCliente">
                                </div>
                            </div> 


                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Cod. Funcionário:</label>
                                <div class="col-sm-9">
                                        <input type="text" style="width:350px;" class="pull-left form-control" name="codFuncionario"/>
                                        <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                                        type="submit" name="buscarFuncionario">Pesquisar</button>
                                </div>
                            </div>
                            
                            <div style="display:none;" class="form-group" id="divNomeFuncionario">
                                <label for="inputPassword3" class="col-sm-3 control-label">Nome Funcionário:</label>
                                <div class="col-sm-9">
                                    <input style="width:350px;" type="text" disabled="true" class="form-control" id="inputPassword3">
                                </div>
                            </div>

                            <div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Cod. Filme:</label>
								<div class="col-sm-9">
                                    <input type="text" style="width:350px;" class="pull-left form-control" name="codFilme"/>
                                    <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                                    type="submit" name="buscarFilme">Pesquisar</button>
								</div>
							</div>
                            

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Cadastrar</button>
                                </div>
                            </div>

                        </form>
                    
                    </div>
                    <div class="col-sm-4"></div>
                </div>


        </div>
    </body>
</html>

<script>
    function buscarCliente(){
        $.ajax({
            url: '../controllers/cadastro.locacoes.controller.php',
            type: 'POST',
            data: {
                codigoCliente: $('#codCliente').val()
            },success:function(data){
                response = JSON.parse(data);
                $("#nomeCliente")[0].value = response.nomeCliente;
                $("#divNomeCliente")[0].style.display = 'inherit';
            },
            error:function(){
                alert("ERRO AO BUSCAR CLIENTE");
            }
        });  
    }
</script>