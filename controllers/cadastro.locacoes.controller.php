<?php
    require_once '../conexao/conexaoBD.php';

    $clienteValido = false;
    $funcionarioValido = false;
    $codCliente = 0;
    $codFuncionario = 0;
    $codFilme = 0;

    if(isset($_REQUEST['codigoCliente'])){
        $codCliente = $_REQUEST['codigoCliente'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        $res = $conexao->query("select * from clientes where cod_cliente = '+$codCliente+'");
        echo json_encode($res->fetch(PDO::FETCH_ASSOC));
    }

    if(isset($_REQUEST["codFuncionario"])){
        $codFuncionario = $_REQUEST['codFuncionario'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        $res = $conexao->query("select * from funcionarios where cod_funcionario = '+$codFuncionario+'");
        echo json_encode($res->fetch(PDO::FETCH_ASSOC));
    }

    if(isset($_REQUEST["codigoFilme"])){
        $codFilme = $_REQUEST['codigoFilme'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        $res = $conexao->query("select * from filmes where cod_filme = '+$codFilme+'");
        echo json_encode($res->fetch(PDO::FETCH_ASSOC));
    }

    // if(isset($_POST["codigoFilmes"]) && isset($_REQUEST['codigoCliente']) && isset($_POST["codFuncionario"])){
    if(isset($_POST["codigoFilmes"])){
            
            
    }

?>