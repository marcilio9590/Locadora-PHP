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
                    <div class="col-sm-4"><h1><label>Edição de Filmes</label></h1></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <table class="table table-bordered table-condensed">
                 
                     

                            <tbody>
                                
                                 <tr>
                                    <td>Nome do Filme:</td>
                                <td><input value="<?php echo $funcionario['nome'] ?>" type="text" id="txtNome"></td>
                            </tr>
                            <tr>
                                    <td>Genero Do Filme:</td> 
                                <td><input type="text" id="txtRua"></td>
                            </tr>
                                
                            <tr>
                                    <td>Preço Do Filme:</td>
                                <td><input type="number" id="txtCep"></td>
                            </tr>
                            
                             <tr>
                              
                             


                                     

                                 <<?php 
                                   if() {




                                   }

                                  ?>
                            </tbody>

                        </table>
                    </div>
                  <div class="col-sm-2"></div>
                  </div>
        </div>
    </body>
</html>
 

 <script>
 function editarFilme(){
        $.ajax({
            url: '../controllers/filme.controller.php',
            type: 'POST',
            data: {
                nomeFilme: ('#txtNomeFilme').val(),
                generoFilme: ('#txtGeneroFilme').val(),
                precoFilme: ('#txtPrecoFilme').val(),
                editarFilme: true
            }, success:function(response){
              console.log(response);
                if(response == true){
                    alert('Filme cadastrado com sucesso');                   
                }else{
                    alert('Erro ao cadastrar Filme');
                }
            }, error:function(response){
                alert("ERRO AO CADASTRAR FILME");
            }
        });  
    }
</script>