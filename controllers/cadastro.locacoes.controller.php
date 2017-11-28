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
        try{
            $res = $conexao->query("select * from clientes where cod_cliente = '+$codCliente+'");
            echo json_encode($res->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e){
            echo "false";
        }
    }

    if(isset($_REQUEST["codFuncionario"])){
        $codFuncionario = $_REQUEST['codFuncionario'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try{
            $res = $conexao->query("select * from funcionarios where cod_funcionario = '+$codFuncionario+'");
            echo json_encode($res->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e){
            echo "false";
        }
    }

    if(isset($_REQUEST["codigoFilme"])){
        $codFilme = $_REQUEST['codigoFilme'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $res = $conexao->query("select * from filmes where cod_filme = '+$codFilme+'");
            echo json_encode($res->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e){
            echo "false";
        }
    }

    if(isset($_REQUEST["requestLocacao"])){
        $obj = $_REQUEST["requestLocacao"];
        $data_atual = date("Y-m-d H:i:s");

        if(isset($obj['codigoCliente']) && isset( $obj['codigoFuncionario']) && 
        isset($obj['totalLocacao']) && isset($obj['filmesSelecionados'])){
            $cliente = $obj['codigoCliente'];
            $funcionario = $obj['codigoFuncionario'];
            $total = $obj['totalLocacao'];
            $filmes = $obj['filmesSelecionados'];
    
    
            $con = new ConexaoBD;
            $conexao = $con->ConnectBD();
    
            try {
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // begin the transaction
                $conexao->beginTransaction();

                $insertLocacao = "INSERT INTO locacoes(cod_cliente, cod_funcionario, data, total, status)
                VALUES ('$cliente','$funcionario','$data_atual','$total',0)";
                $conexao->exec($insertLocacao);

                $res = $conexao->query("SELECT LAST_INSERT_ID()");
                $cod_locacao = $res->fetch(PDO::FETCH_ASSOC)['LAST_INSERT_ID()'];

                // our SQL statements
                for($i = 0; $i < count($filmes); ++$i) {
                    $insertFilmes = "INSERT INTO itens_locacao (cod_locacao,cod_filme) VALUES ($cod_locacao,";
                    $insertFilmes .= $filmes[$i]['cod_filme'];
                    $insertFilmes .= ")";
                    $conexao->exec($insertFilmes);
                    $updateFilme = "UPDATE filmes set status = 0 WHERE cod_filme = :codigo";
                    $sth = $conexao->prepare($updateFilme);
                    $sth->bindParam(':codigo', $filmes[$i]['cod_filme']);
                    $sth->execute();
                }        
                // commit the transaction
                $conexao->commit();
                echo "Locação Cadastrada Com Sucesso.";
            } catch(PDOException $e){
                // roll back the transaction if something failed
                $conexao->rollback();
                echo "false";
            } 
        }else {
            echo "false";
        }

        
    }

?>