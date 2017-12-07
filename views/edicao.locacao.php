<?php require_once('../controllers/locacoes.controller.php'); ?>

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
            <div class="col-sm-4"><h1><label>Editar Locação - <?php echo $locacaoEditar['codigoLocacao'] ?></label></h1></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-6">
                
                <form class="form-horizontal" id="formLocacao">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Cod. Cliente:</label>
                        <div class="col-sm-9">
                            <input disabled="true" value="<?php echo $locacaoEditar['codigoCliente']?>" type="text" style="width:350px;" class="pull-left form-control" name="codCliente" id="codCliente"/>
                            <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                            type="button" id="btnPesquisarCliente" onclick="buscarCliente()">Pesquisar</button>
                            <button onclick="alterar(event)" title="Alterar Cliente" style="margin-left:5px; margin-top:5px; padding:3px;" class="pull-left btn btn-primary btn-xs" 
                            type="button" id="btnalterarCliente">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <div id="divNomeCliente" class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Nome Cliente:</label>
                    <div class="col-sm-9">
                        <input value="<?php echo $locacaoEditar['nomeCliente']?>" style="width:350px;" type="text" disabled="true" class="form-control" id="nomeCliente">
                    </div>
                </div> 


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Cod. Funcionário:</label>
                    <div class="col-sm-9">
                        <input disabled="true" value="<?php echo $locacaoEditar['codigoFuncionario']?>" type="text" style="width:350px;" class="pull-left form-control" id="codFuncionario" name="codFuncionario"/>
                        <button style="margin-left:5px; margin-top:5px;" class="pull-left btn btn-default btn-xs" 
                        type="button" id="buscarFuncionario" onclick="getFuncionario()">Pesquisar</button>
                        <button onclick="alterar(event)" title="Alterar Funcionario" style="margin-left:5px; margin-top:5px; padding:3px;" class="pull-left btn btn-primary btn-xs" 
                        type="button" id="btnRemoverFuncionario">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            
            <div class="form-group" id="divNomeFuncionario">
                <label for="inputPassword3" class="col-sm-3 control-label">Nome Funcionário:</label>
                <div class="col-sm-9">
                    <input value="<?php echo $locacaoEditar['nomeFuncionario']?>" style="width:350px;" type="text" disabled="true" class="form-control" name="nomeFuncionario" id="nomeFuncionario">
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
                    <input value="<?php echo $locacaoEditar['total']?>" disabled type="text" style="width:350px;" class="pull-left form-control" id="totalLocacao" name="totalLocacao"/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-7">
                    <button class="pull-left btn btn-default" 
                    type="button" id="btnCadastrar" onclick="salvarEdicao()">Salvar</button>
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
    var filmes = <?php echo json_encode($locacaoEditar['filmes']) ?>;
    var codLocacao = filmes[0].cod_locacao;
    var novosfilmes = [];
    montarTabelaBase(filmes);

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

    function getFuncionario(){
        $.ajax({
            url: '../controllers/cadastro.locacoes.controller.php',
            type: 'POST',
            data: {
                codFuncionario: $('#codFuncionario').val()
            },success:function(data){
                if(data !== "false"){
                    response = JSON.parse(data);
                    $("#nomeFuncionario")[0].value = response.nome;
                    $("#divNomeFuncionario")[0].style.display = 'inherit';
                    $("#codFuncionario")[0].disabled = true;                    
                    $("#buscarFuncionario")[0].disabled = true;                    
                }else{
                    alert('Código do funcionário incorreto');
                }
            },error:function(){
                alert("ERRO AO BUSCAR FUNCIONARIO");
            }
        });  
    }

    function adicionarFilmes(){
        if(verificarDuplicidade()){
            alert('Filme já inserido na locação')
        }else{
            $.ajax({
                url: '../controllers/cadastro.locacoes.controller.php',
                type: 'POST',
                data: {
                    codigoFilme: $('#codFilme').val()
                },success:function(data){
                    if(data !== "false"){
                        var response = JSON.parse(data);
                        if(response.status === "1"){
                            filmes.push(response);
                            novosfilmes.push(response);
                            montarTabela(filmes);
                            $("#totalLocacao")[0].value = $("#totalLocacao")[0].value ? 
                            parseFloat($("#totalLocacao")[0].value) + parseFloat(response.preco) :
                            parseFloat(response.preco);
                            $("#codFilme")[0].value = '';
                        }else{
                            alert('Filme já encontra-se alugado');
                            $("#codFilme")[0].value = '';
                        }

                    }else{
                        alert('Código do filme incorreto');
                    }
                },error:function(){
                    alert("ERRO AO BUSCAR FILME");
                }
            }); 
        } 
    }

    function verificarDuplicidade(){
        var flag = false;
        if(filmes.length !== 0){
            filmes.forEach(e => {
                if(parseInt(e.cod_filme) === parseInt($('#codFilme').val())){
                    flag = true;
                }
            });
        }
        return flag;
    }

    function montarTabelaBase(filmes){
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
            var $line = $( "<tr id='filme"+i+"'>" );
            $line.append( $( "<td></td>" ).html( filme.cod_filme ) );
            $line.append( $( "<td></td>" ).html( filme.nomefilme ) );
            var parametro = [];
            parametro.push(i);
            parametro.push(filme.codigoitemlocacao);
            parametro.push(filme.cod_filme);
            parametro.push(filme.cod_locacao);
            $line.append( $( "<td><button onclick='removerFilmeBase("+parametro+")' class='btn btn-danger btn-sm' tilte='Remover filme'><span style='cursor:pointer;' class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>" ));
            $line.append( $( "</tr>" ));
            $tbody.append( $line );
        }

        $table.append( $tbody );
        $table.appendTo( document.body );
        $( "#filmesAdicionados" ).empty();
        $table.appendTo($( "#filmesAdicionados" ));
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
            var $line = $( "<tr id='filme"+i+"'>" );
            $line.append( $( "<td></td>" ).html( filme.cod_filme ) );
            $line.append( $( "<td></td>" ).html( filme.nome ) );
            $line.append( $( "<td><button onclick='removerFilme("+i+")' class='btn btn-danger btn-sm' tilte='Remover filme'><span style='cursor:pointer;' class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>" ));
            $line.append( $( "</tr>" ));
            $tbody.append( $line );
        }

        $table.append( $tbody );
        $table.appendTo( document.body );
        $( "#filmesAdicionados" ).empty();
        $table.appendTo($( "#filmesAdicionados" ));
    }

    function removerFilme(index){
        var e = filmes[index];
        $( '#filme'+index).remove();;
        $("#totalLocacao")[0].value = $("#totalLocacao")[0].value && parseFloat($("#totalLocacao")[0].value) > 0 ? 
        parseFloat($("#totalLocacao")[0].value) - parseFloat(e.preco) : '' ;
        filmes.splice(index,1);
        montarTabela(filmes);
    }

    function removerFilmeBase(index,codigoitemlocacao,cod_filme,codigoLocacao){
        if(filmes.length === 1){
            if(confirm('A locação será excluir. Deseja continuar?')){
                $.ajax({
                    url: '../controllers/locacoes.controller.php',
                    type: 'POST',
                    data: {
                        deleteLocacao: codigoLocacao
                    },success:function(data){
                        if(data !== "0"){
                            alert("Locação excluida com sucesso"); 
                            window.location="locacao.php";                
                        }else{
                            alert('Erro ao excluir locação');
                        }
                    },error:function(){
                        alert("ERRO AO EXCLUIR LOCAÇÂO");
                    }
                });
            }
        }else{
            excluirFilmeLocacaoBase(codigoitemlocacao,cod_filme,codigoLocacao);
            var e = filmes[index];
            $( '#filme'+index).remove();;
            $("#totalLocacao")[0].value = $("#totalLocacao")[0].value && parseFloat($("#totalLocacao")[0].value) > 0 ? 
            parseFloat($("#totalLocacao")[0].value) - parseFloat(e.preco) : '' ;
            filmes.splice(index,1);
            montarTabela(filmes);
        }
    }

    function excluirFilmeLocacaoBase(codigoitemlocacao,cod_filme,codigoLocacao){
        return $.ajax({
            url: '../controllers/locacoes.controller.php',
            type: 'POST',
            data: {
                codigoitem: codigoitemlocacao,
                codigoFilme:cod_filme,
                codigoLocacao:codigoLocacao,
                excluirFilmeLocacao:true
            },success:function(data){
                if(data !== "false"){
                 alert('Filme removido');
             }else{
                alert("Erro ao excluir filme");
            }
        },error:function(){
            alert("ERRO AO EXCLUIR FILME");
        }
    }); 
    }

    function salvarEdicao(){
        var codCliente =  $('#codCliente').val();
        var codFuncionario =  $('#codFuncionario').val();
        var total =  $('#totalLocacao').val();
        var objRequest = {
            codigoCliente:codCliente,
            codigoFuncionario:codFuncionario,
            totalLocacao:total,
            codigoLocacao: codLocacao,
            filmes:novosfilmes,
            editarLocacao:true
        };

        $.ajax({
            url: '../controllers/locacoes.controller.php',
            type: 'POST',
            data: {
                requestLocacao: objRequest,
                editarLocacao:true
            },success:function(data){
                if(data !== "false"){
                 alert(data);
                 window.location="locacao.php"; 
             }else{
                alert("Preencha todo o formulário.");
            }
        },error:function(){
            alert("ERRO AO INCLUIR LOCACAO");
        }
    }); 
    }

    function alterar(event){
        var codigo = "#"+event.toElement.parentElement.parentElement.firstElementChild.id; 
        var nome = "#"+event.toElement.parentElement.parentElement.parentElement.nextElementSibling.children[1].firstElementChild.id;
        $(codigo).val("");
        $(nome).val("");
        $(codigo).prop("disabled", false);
    }

</script>