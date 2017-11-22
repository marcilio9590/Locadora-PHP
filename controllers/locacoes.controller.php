<?php
    require_once '../conexao/conexaoBD.php';

    $locacoes;
    $con = new ConexaoBD;
    $conexao = $con->ConnectBD();
    try {
        $res = $conexao->query("select l.cod_locacao, c.nome, l.data, l.total, l.status from locacoes l inner join clientes c on l.cod_cliente = c.cod_cliente");
        $locacoes = $res->fetchAll();
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