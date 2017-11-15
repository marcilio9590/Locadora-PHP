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

    if(isset($_REQUEST["requestLocacao"])){
        $obj = $_REQUEST["requestLocacao"];
        $data_atual = date("Y-m-d H:i:s");
        $cliente = $obj['codigoCliente'];
        $funcionario = $obj['codigoFuncionario'];
        $total = $obj['totalLocacao'];
        $filmes = $obj['filmesSelecionados'];


        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();

        $sth = $conexao->query("INSERT INTO locacoes(cod_cliente, cod_funcionario, data, total, status)
         VALUES ('$cliente','$funcionario','$data_atual','$total',0)");
        
        if($sth){
            echo true;
        }
             
    }

?>