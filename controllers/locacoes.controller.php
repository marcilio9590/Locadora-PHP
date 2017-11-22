<?php
    require_once '../conexao/conexaoBD.php';

    $locacoes = array();
    $con = new ConexaoBD;
    $conexao = $con->ConnectBD();
    try {
        $res = $conexao->query("SELECT l.cod_locacao, c.nome, l.data, l.total, l.status , f.cod_filme, f.nome as nomefilme from locacoes l inner join clientes c on l.cod_cliente = c.cod_cliente inner join itens_locacao il on il.cod_locacao = l.cod_locacao inner join filmes f on f.cod_filme = il.cod_filme");      
        
        $locacoesNaoFormatado = $res->fetchAll();

        $arr = array();

        foreach ($locacoesNaoFormatado as $value) {
            $existe = false;
            if(count($arr) == 0){
                array_push($arr, $value);
            }else{
                foreach ($arr as $value2) {
                    if($value['cod_locacao'] === $value2['cod_locacao']){
                        $existe = true;
                    }
                }
                if($existe == false){
                    array_push($arr, $value);
                }
            }
        }
        $locacoes = $arr;

        for ($i=0; $i < count($locacoes); $i++) { 
            $value = $locacoes[$i];
            for ($j=0; $j < count($locacoesNaoFormatado); $j++) { 
                $value2 = $locacoesNaoFormatado[$j];
                if($value['cod_locacao'] === $value2['cod_locacao']){
                        if(isset($locacoes[$i]['filmes'])){
                            array_push($locacoes[$i]['filmes'], $value2);
                        }else{
                            $locacoes[$i]['filmes'] = array($value2);
                        }
                }
            }
        }





    } catch (PDOException $e){
        echo "false";
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
  


?>