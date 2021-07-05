<?php
    require_once('psicologos.controller.php');
    require_once('escuelas.controller.php');
    require_once('horarios.controller.php');
    $sistema = new Sistema();
    $escuelas = new Escuela();
    $psicologos = new Psicologo();
    $horarios = new Horario();
    
    //$consulta = new Consulta();

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    switch($action){
        
        case 'create':
            $escuela = $escuelas->read();
            $horario = $horarios->read();
            include('views/psicologos/form.php');
            break;

        case 'save':            
            $psicologo = $_POST['psicologo'];
            //print_r($psicologo);
            $resultado = $psicologos->create($psicologo['nombre'], $psicologo['apaterno'], $psicologo['amaterno'], $psicologo['escuela']);
            $datos = $psicologos->read();
            include('views/psicologos/index.php');            
            break;

        case 'delete':
            $id_psicologo = $_GET['id_psicologo'];
            $resultado = $psicologos->delete($id_psicologo);
            $datos = $psicologos->read();
            include('views/psicologos/index.php');            
            break;

        case 'show':
            $id_psicologo = $_GET['id_psicologo'];
            $datos = $psicologos->readOne($id_psicologo);
            include('views/psicologos/form.php');          
            break;

        case 'update':            
            $psicologo = $_POST['psicologo'];
            $resultado = $psicologos->update($psicologo['id_psicologo'],$psicologo['nombre'],$psicologo['apaterno'],$psicologo['amaterno'],$psicologo['escuela']);
            $datos = $psicologos->read();
            include('views/psicologos/index.php');   
            break;  

        case 'my':
            $datos = $psicologos -> read(true);
            include('views/psicologos/index.php');
            break;

        default:
            $datos = $psicologos->read();
            include('views/psicologos/index.php');            
    } 
    include('views/footer.php');  
?>