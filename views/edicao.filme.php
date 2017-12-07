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
         <div class="col-sm-6"><h2><label> Edição do Filme - <?php echo $filme['nome']?></label></h2></div>
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
                  <table> 
                     <form action="filme.controller.php" method="POST">
                        <input name="cod_filme" type="hidden" >
                        <tr>
                            <td>Nome do Filme:</td> 
                            <td><input value="<?php echo $filme['nome'] ?>" type="text" id="txtNome"></td>
                        </tr>
                        
                        <tr>
                            <td>Genero do Filme:</td>
                            <td><input value="<?php echo $filme['genero'] ?>" type="text" id="txtGenero"></td>
                        </tr>
                        
                        <tr>
                            <td>Preço do Filme:</td>
                            <td><input value="<?php echo $filme['preco'] ?>" type="number" id="txtPreco"></td>
                        </tr>
                        
                    </table> 
                    <button title='Salvar' class="pull-left btn btn-default" type="button" id="btnSalvar" onclick="salvarDados()">Salvar</button>
                    
                </form>
            </tbody>

        </table>
    </div>
    <div class="col-sm-2"></div>
</div>
</div>
</body>
</html>


<script>
    var codigo = <?php echo $_GET['codFilme']?>;
    function salvarDados(){
        if($('#txtNome').val() != "" && $('#txtGenero').val() != "" && $('#txtPreco').val() != ""){
            $.ajax({
                url: '../controllers/filme.controller.php',
                type: 'POST',
                data: {
                    codigoFilmeEdicao:        codigo,
                    nomeFilme:   $('#txtNome').val(),
                    generoFilme:    $('#txtGenero').val(),
                    precoFilme:    $('#txtPreco').val(),
                    editarDados: true
                }, success:function(response){
                    if(response != "False"){
                        alert("Filme Editado com Sucesso");
                        window.location="filme.php";                   
                    }else{
                        alert('Erro ao Editar');
                    }
                }, error:function(response){
                    alert("ERRO AO EDITAR");
                }
            });  
        } else {
            alert('Preencha todos os campos.')
        }
    }
</script>