<?php require_once('../controllers/devolucao.controller.php'); ?>

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
                    <div class="col-sm-4"><h1><label>Devolução</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                    <div class="col-sm-2"></div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <table class="table table-bordered table-condensed"><br>
                 
                            <thead>
                                <tr>
                                    <th>Nome do Cliente</th>
                                    <th>Filme Alugado</th>
                                    <th>Data e Hora</th>
                                    <th>Cod Locação</th>
                                    <th>Valor</th>
                                    <th>Efetuar Devolução</th>
                                </tr>
                            </thead>

                            <tbody>
                                  <?php
                                    foreach ($itens_locacao as $value) {
                                        echo "<tr><td>".$value['nome']."</td><td>".$value['nomefilme']."</td><td>".$value['data']."</td><td>".$value['cod_locacao']."</td><td>".$value['total']."</td><td>";
                                        if($value['status'] == 0){
                                                
                                            }else{
                                                echo "Concluida";

                                            }
                                       
               echo "<button class='btn pull-right' onclick='excluirFilme(".$value['cod_filme'].")'> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                                                </td>";
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
 
 <script type="text/javascript">
    
    function excluirLocacao(codigo){
        if(confirm('Deseja realmente excluir este filme?')){
            $.ajax({
                url: '../controllers/devolucao.controller.php',
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