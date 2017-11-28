<?php
    session_start();
    require_once '../conexao/conexaoBD.php';
    $locacoes = array();

    if(isset($_SESSION['locacaoEditar'])){
        $locacaoEditar = $_SESSION['locacaoEditar'];
    }
    $con = new ConexaoBD;
    $conexao = $con->ConnectBD();
    try {
        $res = $conexao->query("SELECT l.cod_locacao, 
        c.nome, l.data, l.total, l.status , f.cod_filme, f.nome as nomefilme, 
        l.cod_funcionario, e.nome as nomeFuncionario, c.cod_cliente,c.telefone, f.preco, il.codigo as codigoitemlocacao
        from locacoes l
        inner join funcionarios e on l.cod_funcionario = e.cod_funcionario
        inner join clientes c on l.cod_cliente = c.cod_cliente 
        left join itens_locacao il on il.cod_locacao = l.cod_locacao 
        left join filmes f on f.cod_filme = il.cod_filme");
        $locacoesNaoFormatado = $res->fetchAll();
        $arrayFormatado = montarArrayLocacoes($locacoesNaoFormatado);
        $locacoes = montarArrayFilmes($arrayFormatado,$locacoesNaoFormatado);
    } catch (PDOException $e){
        echo "false";
    } finally{
        $conexao = null;
    }


    function montarArrayLocacoes($arrayNaoFormatado){
        $arrayLocal = array();
        foreach ($arrayNaoFormatado as $value) {
            $existe = false;
            if(count($arrayLocal) == 0){
                array_push($arrayLocal, $value);
            }else{
                foreach ($arrayLocal as $value2) {
                    if($value['cod_locacao'] === $value2['cod_locacao']){
                        $existe = true;
                    }
                }
                if($existe == false){
                    array_push($arrayLocal, $value);
                }
            }
        }
        return $arrayLocal;
    }

    function montarArrayFilmes($arrayFormatado, $arrayNaoFormatado){
        for ($i=0; $i < count($arrayFormatado); $i++) { 
            $value = $arrayFormatado[$i];
            for ($j=0; $j < count($arrayNaoFormatado); $j++) { 
                $value2 = $arrayNaoFormatado[$j];
                if($value['cod_locacao'] === $value2['cod_locacao']){
                        if(isset($arrayFormatado[$i]['filmes'])){
                            array_push($arrayFormatado[$i]['filmes'], $value2);
                        }else{
                            $arrayFormatado[$i]['filmes'] = array($value2);
                        }
                }
            }
        }
        return $arrayFormatado;
    }


    if(isset($_REQUEST['deleteLocacao'])){
        $codigo = $_REQUEST['deleteLocacao'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->beginTransaction();
           
            $conexao->exec("UPDATE filmes AS a INNER JOIN itens_locacao AS b ON a.cod_filme = b.cod_filme SET a.status = 1 WHERE  b.cod_locacao = $codigo");

            $conexao->exec("DELETE FROM itens_locacao WHERE cod_locacao = $codigo");
            
            $del = $conexao->prepare("DELETE FROM locacoes WHERE cod_locacao = $codigo");
            $del->execute();
            
            $conexao->commit();
            $count = $del->rowCount();
            echo $count;
        } catch (PDOException $e){
            $conexao->rollBack();
            echo "false";
        } finally{
            $conexao = null;
        }
    }
    
    if(isset($_REQUEST['salvarDadosEditar'])){
        $_SESSION['locacaoEditar'] = $_REQUEST;
    }

    if(isset($_REQUEST['excluirFilmeLocacao'])){
        $codigoFilme =  $_REQUEST['codigoFilme'];
        $codigolocacao = $_REQUEST['codigoLocacao'];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $retorno = $conexao->prepare("DELETE from itens_locacao where codigo = :codigo");
            $retorno->bindParam(':codigo', $_REQUEST['codigoitem']);
            $flag = $retorno->execute();
            if($flag == true){
                $conexao->exec("UPDATE filmes set status = 1 where cod_filme = $codigoFilme");
                $conexao->exec("UPDATE locacoes l inner join filmes f on $codigoFilme = f.cod_filme set l.total = l.total - f.preco where l.cod_locacao =  $codigolocacao");
                atualizarLocacaoSession($codigoFilme);
            }
            echo $flag;
        } catch (PDOException $e){
            $conexao->rollBack();
            echo "false";
        } finally{
            $conexao = null;
        }
    }
    
    function atualizarLocacaoSession($codigoFilme){
        $value = $_SESSION['locacaoEditar'];
        for ($i=0; $i < count($value['filmes']); $i++) { 
            $value2 = $value['filmes'][$i];
            if($value2['cod_filme'] == $codigoFilme){
                $_SESSION['locacaoEditar']['total'] = floatval($_SESSION['locacaoEditar']['total']) - floatval($_SESSION['locacaoEditar']['filmes'][$i]['preco']);
                unset($_SESSION['locacaoEditar']['filmes'][$i]);
            }
        }
    }

    if(isset($_REQUEST['editarLocacao'])){
        $obj = $_REQUEST["requestLocacao"];
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->beginTransaction();
            
            $retorno = $conexao->prepare("UPDATE locacoes SET cod_cliente = :codCli,
            cod_funcionario = :codFunc, total = :total WHERE cod_locacao = :codLocacao");
            $retorno->bindParam(':codCli', $obj['codigoCliente']);
            $retorno->bindParam(':codFunc', $obj['codigoFuncionario']);
            $retorno->bindParam(':total', $obj['totalLocacao']);
            $retorno->bindParam(':codLocacao', $obj['codigoLocacao']);
            $flag =  $retorno->execute();
            
            if(isset($obj['filmes'])){
                $cod_locacao = $obj['codigoLocacao'];
                $filmes = $obj['filmes'];
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
            }
            // commit the transaction
            $conexao->commit();
            echo "Locação Alterada Com Sucesso.";

        } catch (PDOException $e){
            $conexao->rollBack();
            echo "false";
        } finally{
            $conexao = null;
        }
        
    }


?>