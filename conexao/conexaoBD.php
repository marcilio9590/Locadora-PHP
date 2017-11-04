<?php
    class ConexaoBD {
        
        private $usuario = "root";
        private $senha = "";
        private $baseName = "base_teste";
        private $host = "localhost";
        public $connection = null;

        public function ConnectBD(){
            $connection = new PDO("mysql:host=localhost;dbname=base_teste", "root", ""); 
            return $connection;
        }

        public function closeConnection(){
            if($connection != null){
                $connection = null;
            }
        }

    }

?>