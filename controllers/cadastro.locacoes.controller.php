<?php
    $clienteValido = false;
    $funcionarioValido = false;
    $codCliente = 0;
    $codFuncionario = 0;
    $codFilme = 0;

    if(isset($_REQUEST['codigoCliente'])){
        //codigo digitado no campo
        $codCliente = $_REQUEST['codigoCliente'];
        //realizar busca na base pelo codigo do cliente
        $result = array("nomeCliente" => "jose");
        echo json_encode($result);
    }

    if(isset($_POST["codFuncionario"])){
        $codFuncionario = $_POST["codFuncionario"];
    }

    if(isset($_POST["codFilme"])){
        $codFilme = $_POST["codFilme"];
    }


?>