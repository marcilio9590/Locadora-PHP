<?php
    require_once '../conexao/conexaoBD.php';

    $clienteValido = false;
    $funcionarioValido = false;
    $codCliente = 0;
    $codFuncionario = 0;
    $codFilme = 0;

    if(isset($_REQUEST['codigoCliente'])){
        //codigo digitado no campo
        $codCliente = $_REQUEST['codigoCliente'];
        //realizar busca na base pelo codigo do cliente


        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        $res = $conexao->query("select * from clientes where cod_cliente = '+$codCliente+'");
        echo json_encode($res->fetch(PDO::FETCH_ASSOC));

    }

    if(isset($_POST["codFuncionario"])){
        $codFuncionario = $_POST["codFuncionario"];
    }

    if(isset($_POST["codFilme"])){
        $codFilme = $_POST["codFilme"];
    }


?>