<?php
		require_once '../conexao/conexaoBD.php'; 
        
        $itens_locacao;
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $res = $conexao->query("select L.cod_locacao, C.nome, F.nome from locacoes L 
inner join clientes C on L.cod_cliente = C.cod_cliente 
inner join itens_locacao IL on IL.cod_locacao = L.cod_locacao 
inner join filmes F on IL.cod_filme = F.cod_filme where L.status = 0");
            $itens_locacao = $res->fetchAll();
        } catch (PDOException $e){
            echo "false";
        }


?>
