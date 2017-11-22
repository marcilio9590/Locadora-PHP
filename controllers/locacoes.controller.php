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
  


?>