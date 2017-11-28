<?php
        require_once '../conexao/conexaoBD.php';
		 $clientes;        
         $con = new ConexaoBD;
         $conexao = $con->ConnectBD();
         try {
             $res = $conexao->query("select * from clientes");
             $clientes = $res->fetchAll();
         } catch (PDOException $e){
             echo "false";
         } finally{
             $conexao = null;
         }

         if(isset($_REQUEST['deletecliente'])){
        	$codigo = $_REQUEST['deletecliente'];
			$con = new ConexaoBD;
	        $conexao = $con->ConnectBD();
	        try {
                $del = $conexao->prepare("DELETE FROM clientes WHERE cod_cliente = $codigo");
                $del->execute();
                $count = $del->rowCount();
                echo $count;
	        } catch (PDOException $e){
	            echo "false";
	        } finally{
                $conexao = null;
            }
        }
 
            
      if (isset($_REQUEST["salvardados"])) {
             $con = new ConexaoBD;
             $conexao = $con->ConnectBD();
             $nomecliente   = $_REQUEST['nomecliente'];
             $enderecocliente    = $_REQUEST['enderecocliente'];
             $bairrocliente  = $_REQUEST['bairrocliente'];
             $cidadecliente = $_REQUEST['cidadecliente'];
             $cpfcliente    = $_REQUEST['cpfcliente'];
             $sexo = $_REQUEST['sexo'];
             $telefonecliente        = $_REQUEST['telefonecliente'];
             $emailcliente = $_REQUEST['emailcliente'];
             $ddd = $_REQUEST['ddd'];
             $estadocliente = $_REQUEST['estadocliente'];
 
             try {
                 $retorno = $conexao->prepare("INSERT INTO clientes( nome, endereco, email, bairro, cidade, cpf, ddd, sexo, estado, telefone)
                  VALUES (:nome,:endereco,:email,:bairro,:cidade,:cpf,:ddd,:sexo,:estado,:telefone)");
                 $retorno->bindParam(':nome', $nomecliente);
                 $retorno->bindParam(':endereco', $enderecocliente);
                 $retorno->bindParam(':email', $emailcliente);
                 $retorno->bindParam(':bairro', $bairrocliente);
                 $retorno->bindParam(':cidade', $cidadecliente);
                 $retorno->bindParam(':cpf', $cpfcliente);
                 $retorno->bindParam(':ddd', $ddd);
                 $retorno->bindParam(':sexo', $sexo);
                 $retorno->bindParam(':estado', $estadocliente);
                 $retorno->bindParam(':telefone', $telefonecliente);
                 $flag = $retorno->execute();
                 echo $flag;
             } catch (PDOException $e) {
                 echo "False";
             } finally{
                 $conexao = null;
             }
         }

         

         if (isset($_REQUEST["editarcliente"])) {
            $nomecliente = $_REQUEST['nomecliente'];
            $endereco = $_REQUEST['enderecocliente'];
            $ddd = $_REQUEST['ddd'];
            $bairrocliente = $_REQUEST['bairrocliente'];
            $cidadecliente = $_REQUEST['cidadecliente'];
            $cpfcliente = $_REQUEST['cpfcliente'];
            $estadocliente = $_REQUEST['estadocliente'];
            $sexo = $_REQUEST['sexo'];
            $emailcliente = $_REQUEST['emailcliente'];
            $telefonecliente = $_REQUEST['telefonecliente'];
            try { 
                $conexao->query("UPDATE clientes SET nomecliente = '$nomecliente', enderecocliente = '$enderecocliente', ddd = '$ddd', bairrocliente = '$bairrocliente', cidadecliente = '$cidadecliente', cpfcliente = '$cpfcliente', emailcliente= '$emailcliente', sexo = '$sexo', estadocliente = '$estadocliente', telefonecliente = '$telefonecliente'  WHERE cod_cliente = '' ");
            } catch (PDOException $e) {
                echo "False";
        }
    }

?>