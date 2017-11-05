<?php
    class ConexaoBD {
        
        public $connection = null;

        public function ConnectBD(){
            $connection = new PDO("mysql:host=localhost;dbname=locadora", "root", ""); 
            return $connection;
        }

        public function closeConnection(){
            if($connection != null){
                $connection = null;
            }
        }

    }

?>