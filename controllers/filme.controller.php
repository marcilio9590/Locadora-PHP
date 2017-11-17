<?php
		require_once '../conexao/conexaoBD.php';

		$listaFilmes;
        $con = new ConexaoBD;
        $conexao = $con->ConnectBD();
        try {
            $res = $conexao->query("select * from filmes");
            $listaFilmes = $res->fetchAll();
        } catch (PDOException $e){
            echo "false";
        }

        if(isset($_REQUEST['codigoFilme'])){
        	$codigo =$_REQUEST['codigoFilme'];
			$con = new ConexaoBD;
	        $conexao = $con->ConnectBD();
	        try {
                $del = $conexao->prepare("DELETE FROM filmes WHERE cod_filme = $codigo");
                $del->execute();
                $count = $del->rowCount();
                echo $count;
	        } catch (PDOException $e){
	            echo "false";
	        }
        }



?>