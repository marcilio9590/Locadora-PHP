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
            $locacoesNaoFormatado = $res->fetchAll();
            $arrayFormatado = montarArrayLocacoes($locacoesNaoFormatado);
            $itens_locacao = montarArrayFilmes($arrayFormatado,$locacoesNaoFormatado);
        } catch (PDOException $e){
            echo "false";
    }

    if(isset($_REQUEST['realizarDevolucao'])){
     $codigoLocacao = $_REQUEST['codigoLocacao'];
     try {
                 $retorno = $conexao->prepare("UPDATE locacoes SET  status = 1 WHERE cod_locacao = :cod");
                 $retorno->bindParam(':cod', $codigoLocacao);

                 $flag = $retorno->execute();
                 if($flag==true){

                 $conexao->exec("UPDATE filmes f INNER JOIN itens_locacao il on f.cod_filme = il.cod_filme 
                    set f.status = 1 where il.cod_locacao = $codigoLocacao");
                 
                 $conexao->commit();

                 }
                 echo $flag;
             } catch (PDOException $e) {
                 echo "False";
             } finally{
                 $conexao = null;
             }

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


?>
