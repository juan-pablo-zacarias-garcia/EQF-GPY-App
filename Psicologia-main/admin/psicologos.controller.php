<?php
    require_once('sistema.controller.php');
    
    /*Clase principal para pacientes */
    class Psicologo extends Sistema{
        var $id_psicologo;
        var $nombre;
        var $apaterno;
        var $amaterno;
        var $escuela;
        var $fotografía;

        function getId_Paciente(){
            return $this->id_psicologo;
        }
        function setId_Paciente($id_psicologo){
            $this->id_psicologo = $id_psicologo;
        }

        function getNombre(){
            return $this->nombre;
        }
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        function getApaterno(){
            return $this->apaterno;
        }
        function setApaterno($apaterno){
            $this->apaterno = $apaterno;
        }

        function getAmaterno(){
            return $this->amaterno;
        }
        function setAmaterno($amaterno){
            $this->amaterno = $amaterno;
        }

        function getFotografia(){
            return $this->fotografia;
        }
        function setFotografia($fotografia){
            $this->fotografia = $fotografia;
        }

        /*
        Método para crear un psicologo
        params  String @nombre nombre del psicologo
                String @apaterno apellido paterno del psicologo
                String @amaterno apellido materno del psicologo
                Date   @escuela fecha de escuela del psicologo
        returns integer
        */

        function create($nombre, $apaterno, $amaterno, $escuela){
            $dbh = $this->connect();
            $foto = $this->guardarFotografia();
            if($foto){
                $sentencia = "INSERT INTO psicologo(nombre, apaterno, amaterno, id_escuela, fotografia) values(:nombre, :apaterno, :amaterno, :escuela, :fotografia)"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':fotografia',$foto, PDO::PARAM_STR);
            }else{
                $sentencia = "INSERT INTO psicologo(nombre, apaterno, amaterno, id_escuela) values(:nombre, :apaterno, :amaterno, :escuela)"; 
                $stmt = $dbh->prepare($sentencia);
            }            
            $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':escuela',$escuela, PDO::PARAM_INT);         
            $resultado = $stmt->execute();
            return $resultado;
        }

        function guardarFotografia(){
            $archivo = $_FILES['fotografia'];
            $tipos = array('image/jpeg', 'image/gif', 'image/png');
            if($archivo['error']==0){
                if(in_array($archivo['type'], $tipos)){
                    if($archivo['size'] <= 2097152){
                        $a = explode('/',$archivo['type']);
                        $nuevoNombre = md5(time()).'.'.$a[1];
                        if(move_uploaded_file($_FILES['fotografia']['tmp_name'], 'archivos/'.$nuevoNombre)){
                            return $nuevoNombre;
                        }
                    }               
                }
            }
            return false;
        }
        /*
        Metodo para obtener todos los psicologos
        returns array
        */
        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM psicologo";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        /*
        metodo para obtener un psicologo
        params int @id id del psicologo
        returns array
        */
        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM psicologo where id_psicologo=:id_psicologo";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_psicologo',$id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        /*
        Método para acyualizar un psicologo
        params  int @id id del psicologo
                String @nombre nombre del psicologo
                String @apaterno apellido paterno del psicologo
                String @amaterno apellido materno del psicologo
                Date   @escuela fecha de escuela del psicologo
                String @domicilio domicilio del psicologo del psicologo
        returns int
        */
        function update($id, $nombre, $apaterno, $amaterno, $escuela){
            $dbh = $this->connect();
            $foto = $this->guardarFotografia();
            if($foto){
                $sentencia = "UPDATE psicologo set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, escuela=:escuela, fotografia=:fotografia where id_psicologo=:id_psicologo"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':fotografia',$foto, PDO::PARAM_STR);
            }else{
                $sentencia = "UPDATE psicologo set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, escuela=:escuela where id_psicologo=:id_psicologo"; 
                $stmt = $dbh->prepare($sentencia);
            }
            $stmt->bindParam(':id_psicologo',$id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':escuela',$escuela, PDO::PARAM_STR);
            $resultado = $stmt->execute();           
            return $resultado;
        }
        
        /*
        metodo para eliminar un psicologo
        params  int @id id del psicologo
        returns int
        */
        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM psicologo where id_psicologo=:id_psicologo";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_psicologo',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }


?>