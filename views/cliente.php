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
            <div class="col-sm-4"><h1><label>Clientes</label></h1></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <a href="cadastro.cliente.php" class="pull-left"> <button class="btn btn-default">Cadastrar Novo Cliente</button></a>
                
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <table class="table table-bordered table-condensed">
                    
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome do Cliente</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        foreach ($clientes as $value) {
                            echo "<tr><td>".$value['cod_cliente']."</td><td>".$value['nome']."</td><td>".$value['cpf']."</td><td>".$value['telefone']."</td><td><a href='edicao.cliente.php?codCliente=".$value['cod_cliente']."'><button title='Editar' class='btn btn-default pull-left'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>
                            <button title='Excluir' class='btn default pull-right' onclick='excluirCliente(".$value['cod_cliente'].")'> <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>


<script>
    
    function excluirCliente(codigo_cliente){
        if(confirm('Deseja realmente excluir este cliente?')){
            $.ajax({
                url: '../controllers/cliente.controller.php',
                type: 'POST',
                data: {
                    deleteCliente: codigo_cliente
                },success:function(data){
                    if(data !== "0"){
                        alert("Cliente excluido com sucesso!"); 
                        location.reload();                 
                    }else{
                        alert('Erro ao excluir cliente!');
                    }
                },error:function(){
                    alert("ERRO AO EXCLUIR CLIENTE!");
                }
            });  
        }
    }

</script>