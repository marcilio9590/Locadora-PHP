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
                    
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Código do cliente</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Código do funcionário</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Código do filme</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>



                            <button type="submit" class="btn btn-default">Enviar</button>
                        </form>
                    
                    </div>
                    <div class="col-sm-4"></div>
                </div>


        </div>
    </body>
</html>