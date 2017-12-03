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
            $conexao = null;
        }


         if(isset($_REQUEST['deleteFuncionario'])){
            $codigo = $_REQUEST['deleteFuncionario'];
            $con = new ConexaoBD;
            $conexao = $con->ConnectBD();
            try {
                $del = $conexao->prepare("DELETE FROM funcionarios WHERE cod_funcionario = $codigo");
                $del->execute();
                $count = $del->rowCount();
                echo $count;
            } catch (PDOException $e){
                echo "false";
            } finally{
                $conexao = null;
            }
        }
        
           
        if (isset($_REQUEST["cadastrarDados"])) {
            $con     = new ConexaoBD;
            $conexao = $con->ConnectBD();
            $nomefuncionario   = $_REQUEST['nomefuncionarios'];
            $ruafuncionario    = $_REQUEST['ruafuncionarios'];
            $cepfuncionario    = $_REQUEST['cepfuncionarios'];
            $bairrofuncionario = $_REQUEST['bairrofuncionarios'];
            $cidadefuncionario = $_REQUEST['cidadefuncionarios'];
            $cpffuncionario    = $_REQUEST['cpffuncionarios'];
            $rgfuncionario     = $_REQUEST['rgfuncionarios'];
            $sexofuncionario   = $_REQUEST['sexofuncionarios'];
            $data_admissao     = $_REQUEST['data_admissaos'];
            $telefonefuncionario  = $_REQUEST['telefonefuncionarios'];
            try {
                $retorno = $conexao->prepare("INSERT INTO funcionarios( nome, rua, cep, bairro, cidade, cpf, rg, sexo,data_admissao, telefone)
                 VALUES (:nome,:rua,:cep,:bairro,:cidade,:cpf,:rg,:sexo,:data_admissao,:telefone)");
                $retorno->bindParam(':nome', $nomefuncionario);
                $retorno->bindParam(':rua', $ruafuncionario);
                $retorno->bindParam(':cep', $cepfuncionario);
                $retorno->bindParam(':bairro', $bairrofuncionario);
                $retorno->bindParam(':cidade', $cidadefuncionario);
                $retorno->bindParam(':cpf', $cpffuncionario);
                $retorno->bindParam(':rg', $rgfuncionario);
                $retorno->bindParam(':sexo', $sexofuncionario);
                $retorno->bindParam(':data_admissao', $data_admissao);
                $retorno->bindParam(':telefone', $telefonefuncionario);
                $flag = $retorno->execute();
                echo $flag;
            } catch (PDOException $e) {
                echo "False";
            } finally{
                $conexao = null;
            }
        }

         if(isset($_REQUEST["editarFuncionario"])){
            $con     = new ConexaoBD;
            $conexao = $con->ConnectBD();
            $cod_func          = $_REQUEST['cod_func'];
            $nomefuncionario   = $_REQUEST['nomefuncionarios'];
            $ruafuncionario    = $_REQUEST['ruafuncionarios'];
            $cepfuncionario    = $_REQUEST['cepfuncionarios'];
            $bairrofuncionario = $_REQUEST['bairrofuncionarios'];
            $cidadefuncionario = $_REQUEST['cidadefuncionarios'];
            $cpffuncionario    = $_REQUEST['cpffuncionarios'];
            $rgfuncionario     = $_REQUEST['rgfuncionarios'];
            $sexofuncionario   = $_REQUEST['sexofuncionarios'];
            $data_admissao     = $_REQUEST['data_admissaos'];
            $telefonefuncionario = $_REQUEST['telefonefuncionarios'];
            
            try {
                $retorno = $conexao->prepare("UPDATE funcionarios SET nome=:nome, rua=:rua, cep=:cep,
                    bairro=:bairro, cidade=:cidade, cpf=:cpf, rg=:rg, sexo=:sexo, data_admissao=:data_admissao, telefone=:telefone WHERE cod_funcionario=:codigo2");
                $retorno->bindParam(':codigo2', $cod_func);
                $retorno->bindParam(':nome', $nomefuncionario);
                $retorno->bindParam(':rua', $ruafuncionario);
                $retorno->bindParam(':cep', $cepfuncionario);
                $retorno->bindParam(':bairro', $bairrofuncionario);
                $retorno->bindParam(':cidade', $cidadefuncionario);
                $retorno->bindParam(':cpf', $cpffuncionario);
                $retorno->bindParam(':rg', $rgfuncionario);
                $retorno->bindParam(':sexo', $sexofuncionario);
                $retorno->bindParam(':data_admissao', $data_admissao);
                $retorno->bindParam(':telefone', $telefonefuncionario);
                $retorno->execute();
                echo "Funcionario editado com sucesso!";
            } catch (PDOException $e){
                echo "false";
            } finally{
                $conexao = null;
            }
        }
?>  