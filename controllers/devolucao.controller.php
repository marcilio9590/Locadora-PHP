<?php
		require_once '../conexao/conexaoBD.php'; 
        
        $itens_locacao;
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $res = $conexao->query("select * from locacoes L inner join clientes C on L.cod_cliente = C.cod_cliente");
            $itens_locacao = $res->fetchAll();
        } catch (PDOException $e){
            echo "false";
        }
?>
