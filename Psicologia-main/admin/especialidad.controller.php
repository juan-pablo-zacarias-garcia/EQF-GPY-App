<?php 
    require_once('sistema.controller.php');

    class Especialidad extends Sistema {

        /*
        Metodo para obtener todos los pacientes
        returns array
        */
        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM carrera";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

    }

?>