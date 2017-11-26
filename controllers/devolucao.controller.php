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

?>
