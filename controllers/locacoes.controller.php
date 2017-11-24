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
        l.cod_funcionario, e.nome as nomeFuncionario, c.cod_cliente
        from locacoes l
        inner join funcionarios e on l.cod_funcionario = e.cod_funcionario
        inner join clientes c on l.cod_cliente = c.cod_cliente 
        inner join itens_locacao il on il.cod_locacao = l.cod_locacao 
        inner join filmes f on f.cod_filme = il.cod_filme");
        $locacoesNaoFormatado = $res->fetchAll();
        $arrayFormatado = montarArrayLocacoes($locacoesNaoFormatado);
        $locacoes = montarArrayFilmes($arrayFormatado,$locacoesNaoFormatado);
    } catch (PDOException $e){
        echo "false";
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
        }
    }

    if(isset($_REQUEST['salvarDadosEditar'])){
        $_SESSION['locacaoEditar'] = $_REQUEST;
        // echo json_encode($locacaoEditar);
    }
  


?>