<?php require_once 'conexao/conexaoBD.php'; ?>
<html>
    <head>
        <script src="resources/bootstrap/js/jquery.min.js"></script>
        <script src="resources/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css" />
        <title>Locadora de filmes 1.0</title>
    </head>
    <body>
    <div>
        <?php require_once('views/menu.php'); ?>
    </div>
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"><label for=""><h1>Locadora de filmes 1.0</h1></label></div>
            <div class="col-md-4"></div>
        </div>
           <!-- 
                 <form action="index.php" method="post">
            <input type="submit" value="Consultar"/>
        </form>    


                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $con = new ConexaoBD;
                $conexao = $con->ConnectBD();
                $res = $conexao->query("select * from teste");
                while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {
                    echo "Nome: {$linha['nome']} - Usuário: {$linha['telefone']}<br />";
                }
            } 
        -->
    </div>

    </body>
</html>