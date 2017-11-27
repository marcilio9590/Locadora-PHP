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
?>