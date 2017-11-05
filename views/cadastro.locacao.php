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
                    <div class="col-sm-6">
                    
                        <form class="form-horizontal" id="formLocacao" method="post">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Cod. Cliente:</label>
                                <div class="col-sm-9">
                                    <input type="text" style="width:350px;" class="pull-left form-control" name="codCliente" id="codCliente"/>
                                    <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                                    type="button" id="btnPesquisarCliente" onclick="buscarCliente()">Pesquisar</button>
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
                                    <input type="text" style="width:350px;" class="pull-left form-control" name="codFilme" id="codFilme"/>
                                    <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                                    type="button" id="btnPesquisarFilmes" onclick="adicionarFilmes()">Adicionar</button>
								</div>
							</div>

                            <div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Total:</label>
								<div class="col-sm-9">
                                    <input disabled type="text" style="width:350px;" class="pull-left form-control" id="totalLocacao" name="totalLocacao"/>
								</div>
							</div>
                         
                            <div class="form-group">
                                <div class="col-sm-offset-5 col-sm-7">
                                    <button type="submit" class="btn btn-default">Cadastrar</button>
                                </div>
                            </div>

                        </form>
                    
                    </div>
                    <div class="col-sm-4">
                    <div id="filmesAdicionados"></div>
                    </div>
                    <div class="col-sm-2"></div>
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
                if(data !== "false"){
                    response = JSON.parse(data);
                    $("#nomeCliente")[0].value = response.nome;
                    $("#divNomeCliente")[0].style.display = 'inherit';
                    $("#codCliente")[0].disabled = true;                    
                    $("#btnPesquisarCliente")[0].disabled = true;                    
                }else{
                    alert('Código do cliente incorreto');
                }
            },error:function(){
                alert("ERRO AO BUSCAR CLIENTE");
            }
        });  
    }
</script>

<script>
   var filmes = [];
    function adicionarFilmes(){
        $.ajax({
            url: '../controllers/cadastro.locacoes.controller.php',
            type: 'POST',
            data: {
                codigoFilme: $('#codFilme').val()
            },success:function(data){
                if(data !== "false"){
                    var response = JSON.parse(data);
                    filmes.push(response);
                    montarTabela(filmes);
                    montarinputHidden(response,filmes);
                    $("#totalLocacao")[0].value = $("#totalLocacao")[0].value ? 
                    parseFloat($("#totalLocacao")[0].value) + parseFloat(response.preco) :
                    parseFloat(response.preco);
                    $("#codFilme")[0].value = '';

                }else{
                    alert('Código do filme incorreto');
                }
            },error:function(){
                alert("ERRO AO BUSCAR FILME");
            }
        });  
    }

    function montarTabela(filmes){
        var $table = $("<table class='text-center table table-striped table-bordered table-condensed'></table>" );
        var $thead = $( "<thead></thead>" );
        var $cabecalho = $( "<tr></tr>" );
        $cabecalho.append("<td><b>Código</b></td>");
        $cabecalho.append("<td><b>Nome</b></td>");
        $cabecalho.append("<td><b>Ações</b></td>");
        $thead.append($cabecalho);
        $table.append( $thead );
        
        var $tbody = $( "<tbody></tbody>" );
        for ( var i = 0; i < filmes.length; i++ ) {
            var filme = filmes[i];
            var $line = $( "<tr>" );
            $line.append( $( "<td></td>" ).html( filme.cod_filme ) );
            $line.append( $( "<td></td>" ).html( filme.nome ) );
            $line.append( $( "<td><span style='cursor:pointer;' onclick='removerFilme("+i+")' class='glyphicon glyphicon-remove' aria-hidden='true'></span></td>" ));
            $line.append( $( "</tr>" ));
            $tbody.append( $line );
        }

        $table.append( $tbody );
        $table.appendTo( document.body );
        $( "#filmesAdicionados" ).empty();
        $table.appendTo($( "#filmesAdicionados" ));
    }

    function montarinputHidden(filme, arrayFilmes){
        var $form =  $( "#formLocacao" );
        $form.append($("<input type='hidden' name='codigoFilmes[]' value='"+filme.cod_filme+"'/>"));
    }

    function removerFilme(filme){
        console.log(filme);
    }
</script>