<?php

class conexion{
    private $user = "root";
    private $pass = "";

    function conectar(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=banco_agricultura', $this->user, $this->pass);
        }catch(PDOException $e){
            echo "Error " . $e->getMessage();
        }
        
    }
}

?>