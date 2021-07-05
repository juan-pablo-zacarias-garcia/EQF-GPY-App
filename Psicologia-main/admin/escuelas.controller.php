<?php 
    require_once('sistema.controller.php');

    class Escuela extends Sistema {

        /*
        Metodo para obtener todos los pacientes
        returns array
        */
        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM escuela";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

    }

?>