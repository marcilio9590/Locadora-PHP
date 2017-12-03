<?php require_once('../controllers/filme.controller.php'); ?>

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
                    <div class="col-sm-4"><h1><label>Filmes</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                    <a href="cadastro.filme.php" class="pull-left"> <button class="btn btn-default">Cadastrar Filme</button></a>
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
                                    <th>Nome do Filme</th>
                                    <th>Genero</th>
                                    <th>Preço</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                <?php
                                    foreach ($listaFilmes as $value) {
                                        echo "<tr><td>".$value['cod_filme']."</td><td>".$value['nome']."</td><td>".$value['genero']."</td><td>".$value['preco']."</td><td>";
                                        if($value['status'] == 1){
                                                echo "<font color='green'>Disponível</font>";
                                            }else{
                                                echo "<font color='red'>Indisponível</font>";
                                            }
                                        echo
                                            "<td>
                                              <a href='edicao.filme.php?codFilme=".$value['cod_filme']."'> <button title='Editar' class='btn pull-left'onclick='editarDados'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>
                                              
                                              <button title='Excluir' class='btn pull-right' onclick='excluirFilme(".$value['cod_filme'].")'> <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>
                                                </td>";
                                        
                                    }
                                //?>

                            </tbody>

                        </table>
                    </div>
                  <div class="col-sm-2"></div>
                  </div>
        </div>
    </body>
</html>

<script>
    
    function excluirFilme(codigo){
        if(confirm('Deseja realmente excluir este filme?')){
            $.ajax({
                url: '../controllers/filme.controller.php',
                type: 'POST',
                data: {
                    codigoFilme: codigo
                },success:function(data){
                    if(data !== "0"){
                        alert('Filme Excluido');
                        location.reload();  
                        console.log(data);                
                    }else{
                        alert('Filme não pode ser excluido pois encontra-se cadastrado em uma ou mais locações.');
                    }
                },error:function(){
                    alert("ERRO AO EXCLUIR FILME");
                }
            });
        }  
    }
</script>
