<?php
        require_once '../conexao/conexaoBD.php';
		 $funcionarios;        
         $con = new ConexaoBD;
         $conexao = $con->ConnectBD();
         try {
             $res = $conexao->query("select * from clientes");
             $funcionarios = $res->fetchAll();
         } catch (PDOException $e){
             echo "false";
         } finally{
             $conexao = null;
         }
 
            
      if (isset($_REQUEST["salvardados"])) {
             $con = new ConexaoBD;
             $conexao = $con->ConnectBD();
             $cod_cliente   = $_REQUEST['cod_funcionario'];
             $nomecliente   = $_REQUEST['nome'];
             $enderecocliente    = $_REQUEST['endereco'];
             $bairrocliente  = $_REQUEST['bairro'];
             $cidadecliente = $_REQUEST['cidade'];
             $cpfcliente    = $_REQUEST['cpf'];
             $sexo = $_REQUEST['sexo'];
             $telefonecliente        = $_REQUEST['telefone'];
             $emailcliente = $_REQUEST['email'];
             $ddd = $_REQUEST['ddd'];
             $estadocliente = $_REQUEST['estado'];
 
             try {
                 $retorno = $conexao->prepare("INSERT INTO cliente(cod_cliente, nome, endereco, email, bairro, cidade, cpf, ddd, sexo, estado, telefone)
                  VALUES (:cod_cliente,:nome,:endereco,:email,:bairro,:cidade,:cpf,:ddd,:sexo,:estado,:telefone)");
                 $retorno->bindParam(':cod_funcionario', $cod_ciente);
                 $retorno->bindParam(':nome', $nomecliente);
                 $retorno->bindParam(':endereco', $enderecocliente);
                 $retorno->bindParam(':email', $emailcliente);
                 $retorno->bindParam(':bairro', $bairroFuncionario);
                 $retorno->bindParam(':cidade', $cidadeFuncionario);
                 $retorno->bindParam(':cpf', $cpfFuncionario);
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