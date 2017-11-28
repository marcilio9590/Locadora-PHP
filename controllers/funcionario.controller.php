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

        

           
     if (isset($_REQUEST["salvarDados"])) {
            $con = new ConexaoBD;
            $conexao = $con->ConnectBD();
            $nomefuncionario   = $_REQUEST['nomefuncionarios'];
            $ruafuncionario    = $_REQUEST['ruafuncionarios'];
            $cepfuncionario    = $_REQUEST['cepfuncionarios'];
            $bairrofuncionario = $_REQUEST['bairrofuncionarios'];
            $cidadefuncionario = $_REQUEST['cidadefuncionarios'];
            $cpffuncionario    = $_REQUEST['cpffuncionarios'];
            $rgfuncionario     = $_REQUEST['rgfuncionarios'];
            $sexofuncionario   = $_REQUEST['sexofuncionarios'];
            $data_admissao = $_REQUEST['data_nascimentofuncionarios'];
            $telefonefuncionario        = $_REQUEST['telefonefuncionarios'];

            try {
                $retorno = $conexao->prepare("INSERT INTO funcionarios( nome, rua, cep, bairro, cidade, cpf, rg, sexo, data_nascimento, telefone)
                 VALUES (:nome,:rua,:cep,:bairro,:cidade,:cpf,:rg,:sexo,:data_nascimento,:telefone)");
                $retorno->bindParam(':nome', $nomeFuncionario);
                $retorno->bindParam(':rua', $ruaFuncionario);
                $retorno->bindParam(':cep', $cepFuncionario);
                $retorno->bindParam(':bairro', $bairroFuncionario);
                $retorno->bindParam(':cidade', $cidadeFuncionario);
                $retorno->bindParam(':cpf', $cpfFuncionario);
                $retorno->bindParam(':rg', $rgFuncionario);
                $retorno->bindParam(':sexo', $sexoFuncionario);
                $retorno->bindParam(':data_nascimento', new datetime($data_admissao));
                $retorno->bindParam(':telefone', $telefoneFuncionario);
                $flag = $retorno->execute();
                echo $flag;
            } catch (PDOException $e) {
                echo "False";
            } finally{
                $conexao = null;
            }
        }

        /*if (isset($_REQUEST["editarFuncionario"])) {
            $cod_Funcionario = $_REQUEST['cod_funcionario'];
            $nomeFuncionario = $_REQUEST['nomeFuncionario'];
            $ruaFuncionario = $_REQUEST['ruaFuncionario'];
            $cepFuncionario = $_REQUEST['cepFuncionario'];
            $bairroFuncionario = $_REQUEST['bairroFuncionario'];
            $cidadeFuncionario = $_REQUEST['cidadeFuncionario'];
            $cpfFuncionario = $_REQUEST['cpfFuncionario'];
            $rgFuncionario = $_REQUEST['rgFuncionario'];
            $sexoFuncionario = $_REQUEST['sexoFuncionario'];
            $data_nascimentoFuncionario = $_REQUEST['data_nascimento'];
            $telefoneFuncionario = $_REQUEST['telefoneFuncionario'];
            try { 
                $conexao->query("UPDATE funcionarios SET cod_funcionario = '$cod_Funcionario', nomeFuncionario= '$nomeFuncionario', ruaFuncionario = '$ruaFuncionario', cepFuncionario = '$cepFuncionario',
                 bairroFuncionario = '$bairroFuncionario', cidadeFuncionario = '$cidadeFuncionario', cpfFuncionario = '$cpfFuncionario', rgFuncionario= '$rgFuncionario', sexoFuncionario = '$sexoFuncionario', data_nascimento = '$data_nascimentoFuncionario', telefone = '$telefoneFuncionario'  WHERE cod_funcionario = '' ");
            } catch (PDOException $e) {
                echo "False";
        }
    }*/

?>  