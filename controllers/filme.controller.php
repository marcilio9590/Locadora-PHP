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
        } finally{
            $conexao = null;
        }

        if(isset($_REQUEST['codigoFilme'])){
        	$codigo = $_REQUEST['codigoFilme'];
			$con = new ConexaoBD;
	        $conexao = $con->ConnectBD();
	        try {
                $del = $conexao->prepare("DELETE FROM filmes WHERE cod_filme = $codigo");
                $del->execute();
                $count = $del->rowCount();
                echo $count;
	        } catch (PDOException $e){
	            echo "false";
	        } finally{
                $conexao = null;
            }
        }

     if (isset($_REQUEST["cadastrarFilme"])) {
            $con = new ConexaoBD;
            $conexao = $con->ConnectBD();
            $nome = $_REQUEST['nomeFilme'];
            $genero = $_REQUEST['generoFilme'];
            $preco = $_REQUEST['precoFilme'];
            try {
                $retorno = $conexao->prepare("INSERT INTO filmes(nome, genero, status, preco) VALUES (:nome,:genero,1,:preco)");
                $retorno->bindParam(':nome', $nome);
                $retorno->bindParam(':genero', $genero);
                $retorno->bindParam(':preco', $preco);
                $flag = $retorno->execute();
                echo $flag;
            } catch (PDOException $e) {
                echo "False";
            } finally{
                $conexao = null;
            }
        }


        if (isset($_REQUEST["editarFilme"])) {
            $nome = $_REQUEST['nomeFilme'];
            $genero = $_REQUEST['generoFilme'];
            $preco = $_REQUEST['precoFilme'];
            try { 
                $conexao->query("UPDATE filme SET nome = '$nome', genero= '$genero', preco = '$preco'  WHERE nome = '' ");
            } catch (PDOException $e) {
                echo "False";
            }
          /*if(mysql_affected_rows() > 0){
              echo "Sucesso: Atualizado corretamente!";
          }else{
              echo "Aviso: Não foi atualizado!";
            }*/
        }

?>  