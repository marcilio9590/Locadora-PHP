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
                    <div class="col-sm-4"><h1><label>Locações</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                    <a href="cadastro.locacao.php" class="pull-left"> <button class="btn btn-default">Cadastrar Locação</button></a>
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
                                    <th>Data</th>
                                    <th>Total</th>
                                    <th>Situação</th>
                                    <th>Filmes</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                                	foreach ($locacoes as $value) {
                                		echo "<tr><td>".$value['cod_locacao']."</td><td>".$value['nome']."</td><td>".$value['data']."</td><td>".$value['total']."</td><td>";
                                		if($value['status'] == 0){
                                				echo "<font color='red'>Em Aberto</font>";
                                			}else{
                                				echo "Concluida";
                                            }
                                        echo "<td>";
                                            if(isset($value['filmes'])){
                                                foreach ($value['filmes'] as $filme) {
                                                    echo "<font color='blue'>".$filme["nomefilme"]."</font><br>";
                                                }
                                            }
                                        echo "</td>";
                                        
                                		echo"</td>
                                				<td>
                                                    <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
                                                    if($value['status'] == 0){
                                                        echo"<button class='btn pull-right' onclick='excluirLocacao(".$value['cod_locacao'].")'> <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>";
                                                    }
                                                echo "</td>
                            		 		</tr>";
                                		
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

     function excluirLocacao($codigo_locacao){
        $.ajax({
            url: '../controllers/locacoes.controller.php',
            type: 'POST',
            data: {
                deleteLocacao: $codigo_locacao
            },success:function(data){
                if(data !== "0"){
                    alert("Locação excluida com sucesso"); 
                    location.reload();                 
                }else{
                    alert('Erro ao excluir locação');
                }
            },error:function(){
                alert("ERRO AO EXCLUIR LOCAÇÂO");
            }
        });  
    }

</script>