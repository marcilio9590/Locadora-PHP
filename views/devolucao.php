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
            <div class="col-sm-4"><h1><label>Devoluções</label></h1></div>
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
                                <th>Código - Nome Filme</th>
                                <th>Data e Hora</th>
                                <th>Cod Locação</th>
                                <th>Valor</th>
                                <th>Efetuar Devolução</th>
                            </tr>
                        </thead>

                        <tbody>
                          <?php
                          foreach ($itens_locacao as $value) {
                            echo "<tr><td>".$value['nome']."</td><td>";
                                            //.$value['nomefilme'].
                            foreach ($value['filmes'] as $value2) { 
                                echo "<font color='green'>".$value2['cod_filme']." </font> - <font color='blue'>".$value2['nomefilme']." </font><br>";
                            } 
                            echo "</td><td>".$value['data']."</td><td>".$value['cod_locacao']."</td><td>".$value['total']."</td><td>";
                            if($value['status'] == 0){
                                
                            }else{
                                echo "Concluida";

                            }
                            
                            echo "<button title='Confirmar' class='btn pull-right btn-success' onclick='efetuarDevolucao(".$value['cod_locacao'].")'> <span class='glyphicon glyphicon-check' aria-hidden='true'></span></button>
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
    
    function efetuarDevolucao(codigo){
        if(confirm('Deseja realmente devolver este filme?')){
            $.ajax({
                url: '../controllers/devolucao.controller.php',
                type: 'POST',
                data: {
                    codigoLocacao: codigo,
                    realizarDevolucao: true
                },success:function(data){
                    if(data !== "0"){
                        alert('Filme devolvido com sucesso');
                        location.reload();  
                        console.log(data);                
                    }else{
                        alert('Filme não pode ser devolvido pois encontra-se cadastrado em uma ou mais locações.');
                    }
                },error:function(){
                    alert("ERRO AO DEVOLVER FILME");
                }
            });
        }  
    }
</script>