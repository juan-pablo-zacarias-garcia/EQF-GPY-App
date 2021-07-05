<?php
    include('../sistema.controller.php');
    $sistema = new Sistema();
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('../views/header.php');
    $mensaje = '';
    
    switch($action){

      case 'logout':
        unset($_SESSION);
        session_destroy();
        $mensaje = 'Ha salido del sistema.';
        include('views/login.php');
        break;

      case 'forget':
            include('views/forget.php');
            break;

      case 'send_pass':
          $correo = $_POST['correo'];
          if($sistema->validarEmail($correo)){
              $sistema->changePass($correo);                
          }
          break;

      case 'change_pass':
          $correo = $_GET['correo'];
          $token = $_GET['token'];
          if($sistema->validarToken($correo,$token)){
              include('views/changePass.php');
          }else{
              header("Location: http://www.gmail.com");
          }

      case 'save_pass':
          $correo = $_POST['correo'];
          $token = $_POST['token'];
          $contrasena = $_POST['contrasena'];
          if($sistema->resetPassword($correo, $token, $contrasena))
          {
            $mensaje = 'La contraseña fue cambiada';
            
          }
          break;

      case 'validar':
        if(isset($_POST['enviar'])){
          $correo = $_POST['correo'];
          $contrasena = $_POST['contrasena'];
          if($sistema -> validarCorreo($correo))
          {
            if($sistema -> validarUsuario($correo, $contrasena))
            {
              $roles = $sistema -> getRoles($correo);
              $permisos = $sistema -> getPermisos($correo);
              $id_usuario = $sistema->getIdUsuario($correo);
              $_SESSION['validado'] = true;
              $_SESSION['roles'] = $roles;
              $_SESSION['permisos'] = $permisos;
              $_SESSION['correo'] = $correo;
              $_SESSION['id_usuario'] = $id_usuario;
              header('Location: ../index.php');

            } 
            else
            { 
              $mensaje = 'Usuario o Contraseña Incorrectos';
            }
          } 
        }
                
      default:
          include('views/login.php');            
    } 
    include('../views/footer.php'); 
?>