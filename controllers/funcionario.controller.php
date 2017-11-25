<?php
		require_once '../conexao/conexaoBD.php';

        $funcionarios;        
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $res = $conexao->query("select * from funcionarios");
            $funcionarios = $res->fetchAll();
        } catch (PDOException $e){
            echo "false";
        } finally{
            $conexao = "";
        }    
    
?>  