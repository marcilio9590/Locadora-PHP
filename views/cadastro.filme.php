<?php require_once('../controllers/filme.controller.php'); ?>

<html>
    <head>
        <script src="../resources/bootstrap/js/jquery.min.js"></script>
        <script src="../resources/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css" />
        <title>Locadora de filmes 1.0</title>
    </head>
    <body>
        <div>
            <?php require_once('menu.php'); ?>
        </div>
        <div class="container-fluid"> 
                <div class="row">
                    <div class="col-sm-6"><h1><label>Cadastro de Filmes</label></h1></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4"></div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                                <form method="post" action="">
                                    <table border="0" class="table">
                                      <tr>
                                             <td>Nome do Filme :</td>
                                           <td><input type="text" id="txtNomeFilme"></td>
                                      </tr>
                                      <tr>
                                             <td>Genero:</td>
                                           <td><input type="text" id="txtGeneroFilme"></td>
                                      </tr>
                                      <tr>
                                             <td>Preço:</td> 
                                           <td><input type="double" id="txtPrecoFilme"></td>
                                      </tr>
                                          
                                      <!-- <tr>
                                              <td>Status:</td>
                                           <td><input type="number" id="txtStatusFilme"></td>
                                      </tr>-->
                                       
                                      
                                    </table>
                                    <button onclick="cadastrarFilme()" class="btn btn-default">Salvar</button>
                                </form>
                    </div>
                   
               </div>
        </div>
    </body>
</html>

<script>
    
     function cadastrarFilme(){
        $.ajax({
            url: '../controllers/filme.controller.php',
            type: 'POST',
            data: {
                nomeFilme: $('#txtNomeFilme').val(),
                generoFilme: $('#txtGeneroFilme').val(),
                precoFilme: $('#txtPrecoFilme').val()
            }, success:function(response){
                if(response != "false"){
                    alert('Filme cadastrado com sucesso');                   
                }else{
                    alert('Erro ao cadastrar Filme');
                }
            }, error:function(response){
                console.log(response);
                alert("ERRO AO CADASTRAR FILME");
            }
        });  
    }

</script>

