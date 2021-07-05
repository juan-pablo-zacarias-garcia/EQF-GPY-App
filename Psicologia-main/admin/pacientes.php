<?php
    require_once('pacientes.controller.php');
    require_once('escuelas.controller.php');
    require_once('horarios.controller.php');
    require_once('especialidad.controller.php');
    $sistema = new Sistema();
    $escuelas = new Escuela();
    $pacientes = new Paciente();
    $horarios = new Horario();
    $especialidades = new Especialidad();
    
    //$consulta = new Consulta();

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    switch($action){
        
        case 'create':
            $especialidad = $especialidades->read();
            include('views/pacientes/form.php');
            break;

        case 'save':            
            $paciente = $_POST['paciente'];
            //print_r($paciente);
            $resultado = $pacientes->create($paciente['nombre'], $paciente['apaterno'], $paciente['amaterno'], $paciente['escuela']);
            $datos = $pacientes->read();
            include('views/pacientes/index.php');            
            break;

        case 'delete':
            $id_paciente = $_GET['id_paciente'];
            $resultado = $pacientes->delete($id_paciente);
            $datos = $pacientes->read();
            include('views/pacientes/index.php');            
            break;

        case 'show':
            $id_paciente = $_GET['id_paciente'];
            $datos = $pacientes->readOne($id_paciente);
            include('views/pacientes/form.php');          
            break;

        case 'update':            
            $paciente = $_POST['paciente'];
            $resultado = $pacientes->update($paciente['id_paciente'],$paciente['nombre'],$paciente['apaterno'],$paciente['amaterno'],$paciente['escuela']);
            $datos = $pacientes->read();
            include('views/pacientes/index.php');   
            break;  

        case 'my':
            $datos = $pacientes -> read(true);
            include('views/pacientes/index.php');
            break;

        default:
            $datos = $pacientes->read();
            include('views/pacientes/index.php');            
    } 
    include('views/footer.php');  
?>