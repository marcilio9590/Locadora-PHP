<?php
		require_once '../conexao/conexaoBD.php'; 
        
        $itens_locacao;
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $res = $conexao->query("SELECT l.cod_locacao, 
        c.nome, l.data, l.total, l.status , f.cod_filme, f.nome as nomefilme, 
        l.cod_funcionario, e.nome as nomeFuncionario, c.cod_cliente, f.preco, il.codigo as codigoitemlocacao
        from locacoes l
        inner join funcionarios e on l.cod_funcionario = e.cod_funcionario
        inner join clientes c on l.cod_cliente = c.cod_cliente 
        left join itens_locacao il on il.cod_locacao = l.cod_locacao 
        left join filmes f on f.cod_filme = il.cod_filme WHERE l.status=0");
            $itens_locacao = $res->fetchAll();
        } catch (PDOException $e){
            echo "false";
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


    
    if(isset($_REQUEST['salvarDadosEditar'])){
        $_SESSION['locacaoEditar'] = $_REQUEST;
    }

    if(isset($_REQUEST['atualizarFilmeLocacao'])){
        $codigoFilme =  $_REQUEST['codigoFilme'];
        $codigolocacao = $_REQUEST['codigoLocacao'];
        try {
            
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
        }
    }
    
    function atualizarLocacaoSession($codigoFilme){
        // foreach ($_SESSION['locacaoEditar'] as  $value) {
            $value = $_SESSION['locacaoEditar'];
            for ($i=0; $i < count($value['filmes']); $i++) { 
                $value2 = $value['filmes'][$i];
                if($value2['cod_filme'] == $codigoFilme){
                    $_SESSION['locacaoEditar']['total'] = floatval($_SESSION['locacaoEditar']['total']) - floatval($_SESSION['locacaoEditar']['filmes'][$i]['preco']);
                    unset($_SESSION['locacaoEditar']['filmes'][$i]);
                }
            }
        }

  

?>
