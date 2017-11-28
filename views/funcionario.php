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
                    <div class="col-sm-4"><h1><label>Funcionário</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                    <a href="cadastro.funcionario.php" class="pull-left"> <button class="btn btn-default">Cadastrar Novo Funcionário</button></a>
                    <div class="col-sm-2"></div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <table class="table table-bordered table-condensed"><br>
                 
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome Funcionário</th>
                                    <th>Rua</th>
                                    <th>Bairro</th>
                                    <th>Cidade</th>
                                    <th>Cpf</th>
                                    <th>Rg</th>
                                    <th>Data Admissão</th>
                                    <th>Telefone</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($funcionarios as $value) {
                                        echo "<tr><td>".$value['cod_funcionario']."</td><td>".$value['nome']."</td><td>".$value['rua']."</td><td>".$value['bairro']."</td><td>".$value['cidade']."</td><td>".$value['cpf']."</td><td>".$value['rg']."</td><td>".$value['data_admissao']."</td><td>".$value['telefone']."</td>
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
  