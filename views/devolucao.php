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
                   <a href="cadastro.locacao.php" class="pull-left"> <button class="btn btn-default">Realizar Devolução</button></a> 
                    <div class="col-sm-2"></div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <table class="table table-bordered table-condensed"><br>
                 
                            <thead>
                                <tr>
                                    <th>Código locação</th>
                                    <th>Nome do Cliente</th>
                                    <th>Filmes</th>
                                    <th>Ações</th>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                  <?php
                                    foreach ($itens_locacao as $value) {
                                        echo "<tr><td>".$value['cod_locacao']."</td><td>".$value['nome']."</td><td>"."</td>";
                                        echo"</td>
                                                <td>
                                                    <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                                                    <button class='btn pull-right' onclick='excluirLocacoes(".$value['cod_locacao'].")'> <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>
                                                </td>
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
