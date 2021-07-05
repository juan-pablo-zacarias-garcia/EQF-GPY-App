<?php 
    require_once('sistema.controller.php');

    class Horario extends Sistema {

        /*
        Metodo para obtener todos los horarios
        returns array
        */
        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT h.id_horario, d.dia, CONCAT(p.hora_inicio,'-',p.hora_fin) as rango FROM horario h join dia d on h.id_dia=d.id_dia join periodo p on h.id_periodo=p.id_periodo";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

    }

?>