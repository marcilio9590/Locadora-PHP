
<?php 
require_once '../conexao/conexaoBD.php';
    $con = new ConexaoBD;
    $conexao = $con->ConnectBD();
    if(isset($_GET['codFilme'])){
        $cod = $_GET['codFilme'];
        $res = $conexao->query("SELECT * from filmes where cod_filme = $cod");
        $filme = $res->fetchAll()[0];
    }

?>

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
                 <div class="col-sm-6"><h2><label> Edição do Funcionário - <?php echo $filme['nome']?></label></h2></div>
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
                                <td><input type="text" id="txtGenero"></td>
                            </tr>
                            
                             <tr>
                                    <td>Preço do Filme:</td>
                                <td><input type="number" id="txtPreco"></td>
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
  var editarFilme = [0];
    var codigo = <?php echo $editarFilme['cod_filme'];?>
    
     function salvarDados(){
        $.ajax({
            url: '../controllers/filme.controller.php',
            type: 'POST',
            data: {
                codigoFilme:  codigo;
                nomefuncionarios:   $('#txtNome').val(),
                ruafuncionarios:    $('#txtGenero').val(),
                cepfuncionarios:    $('#txtPreco').val(),
               
                editarDados: true
            }, success:function(response){
                if(response.trim() == "1"){
                    alert('Funcionário Cadastrado');
                    location.reload();                   
                }else{
                    alert('Erro ao Cadastrar');
                }
            }, error:function(response){
                alert("ERRO AO CADASTRAR");
            }
        });  
    }
</script>