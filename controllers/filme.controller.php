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
 
        if(isset($_GET['codFilme'])){
            $con = new ConexaoBD;
            $conexao = $con->ConnectBD();
            $cod = $_GET['codFilme'];
            try{
                $res = $conexao->query("SELECT * from filmes where cod_filme = $cod");
                $filme = $res->fetchAll()[0];
            } catch (PDOException $e) {
                echo "False";
            } finally{
                $conexao = null;
            }
        }

       if(isset($_REQUEST["editarDados"])) {
            $con = new ConexaoBD;
            $conexao = $con->ConnectBD();
            $cod_filme = $_REQUEST['codigoFilmeEdicao'];
            $nome = $_REQUEST['nomeFilme'];
            $genero = $_REQUEST['generoFilme'];
            $preco = $_REQUEST['precoFilme'];          
             
            try{
                $retorno = $conexao->prepare("UPDATE filmes SET nome=:nome, genero=:genero,preco=:preco WHERE cod_filme = :codigo" );
                $retorno->bindParam(':nome', $nome);
                $retorno->bindParam(':genero', $genero);
                $retorno->bindParam(':preco', $preco);
                $retorno->bindParam(':codigo', $cod_filme);
                $retorno->execute();
                echo "Filme Editado Com Sucesso!";
            }catch (PDOException $e) {
                echo "False";
            } finally{
                $conexao = null;
            } 
        }


?>     
        
