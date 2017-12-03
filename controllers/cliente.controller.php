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
 
            
      if (isset($_REQUEST["salvarDados"])) {
             $con     = new ConexaoBD;
             $conexao = $con->ConnectBD();
             $nomec      = $_REQUEST['nomeCliente'];
             $emailc     = $_REQUEST['emailCliente'];
             $cpfc       = $_REQUEST['cpfCliente'];
             $sexoc      = $_REQUEST['sexo'];
             $telefonec  = $_REQUEST['telefoneCliente'];
             $enderecoc  = $_REQUEST['enderecoCliente'];
             $bairroc    = $_REQUEST['bairroCliente'];
             $cidadec    = $_REQUEST['cidadeCliente'];            
             $estadoc    = $_REQUEST['estadoCliente']; 
             try {
                $retorno = $conexao->prepare("INSERT INTO clientes( nome, email, cpf, sexo, telefone, endereco, bairro, cidade, estado)
                 VALUES (:nome, :email, :cpf, :sexo, :telefone, :endereco, :bairro, :cidade, :estado)");
                 $retorno->bindParam(':nome', $nomec);
                 $retorno->bindParam(':email', $emailc);
                 $retorno->bindParam(':cpf', $cpfc);
                 $retorno->bindParam(':sexo', $sexoc);
                 $retorno->bindParam(':telefone', $telefonec);
                 $retorno->bindParam(':endereco', $enderecoc);
                 $retorno->bindParam(':bairro', $bairroc);
                 $retorno->bindParam(':cidade', $cidadec);
                 $retorno->bindParam(':estado', $estadoc);
                 $flag = $retorno->execute();
                 echo $flag;
             } catch (PDOException $e) {
                 echo "False";
             } finally{
                 $conexao = null;
             }
         }

?>