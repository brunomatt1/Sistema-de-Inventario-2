<?php
    #almacenando datos#
    $usuario=limpiar_cadena($_POST['login_usuario']);
    $clave=limpiar_cadena($_POST['login_clave']);

    if($usuario=="" || $clave==""){
        echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado los campos que son obligatorios
        </div>
        ';
        exit();
    }

    if(verificar_datos("[a-z0-9_.]{4,20}",$usuario)){
         echo '
        <div class="notification is-danger is-light">
            <strong>¡ERROR DE USUARIO!</strong><br>
            NO SE HA ENCONTRADO EL USUARIO, favor verifique
            </div>
        ';
        exit();

    }

    if(verificar_datos("[a-zA-Z0-9]{7,100}",$clave)){
         echo '
        <div class="notification is-danger is-light">
            <strong>¡CLAVE INCORRECTA!</strong><br>
            Favor verifique e intente de nuevo
            </div>
        ';
        exit();
    }

    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuario WHERE usuario_usuario='$usuario' ");

    /* si el rowCount devuelve 0 el usuario no existe y 
    salta al else mayor o externo */
    if($check_user->rowCount()==1){
        $check_user=$check_user->fetch();
        
        if($check_user['usuario_usuario']==$usuario && password_verify($clave,$check_user['usuario_clave'])
        ){

            $_SESSION['id']=$check_user['usuario_id'];
            $_SESSION['nombre']=$check_user['usuario_nombre'];
            $_SESSION['apellido']=$check_user['usuario_apellido'];
            $_SESSION['usuario']=$check_user['usuario_usuario'];

            if(headers_sent()){
                echo "<script>window.location.href='index.php?vista=home'</script>";
            }else{  
                header("location: index.php?vista=home");
            }
            
        #este else se ejecuta Si el usuario existe (rowCount == 1) pero password_verify devuelve FALSE
        }else{
            echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                USUARIO o CLAVE incorrectos
            </div>
        ';
        }
    #else mayor o externo
    }else{
        echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            USUARIO o CLAVE incorrectos
            </div>
        ';
    }
    $check_user=null;