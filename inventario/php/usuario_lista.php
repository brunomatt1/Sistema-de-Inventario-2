<?php

    $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
    $tabla="";

    if(isset($busqueda) && $busqueda!=""){
        $consulta_datos="SELECT * FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."') AND (usuario_nombre LIKE '%busqueda%' OR usuario_apellido LIKE '%busqueda%' OR usuario_usuario LIKE '%busqueda%' OR usuario_email LIKE '%busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio, $registros";

        $consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."') AND (usuario_nombre LIKE '%busqueda%' OR usuario_apellido LIKE '%busqueda%' OR usuario_usuario LIKE '%busqueda%' OR usuario_email LIKE '%busqueda%'))";
    }else{
        $consulta_datos="SELECT * FROM usuario WHERE usuario_id!='".$_SESSION['id']."' ORDER BY usuario_nombre ASC LIMIT $inicio, $registros";

        $consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id!='".$_SESSION['id']."'";     
    }

    $conexion=conexion();

    $datos=$conexion->query($consulta_datos);
    $datos=$datos->fetchAll();

    $total=$conexion->query($consulta_datos);
    $total=(int) $total->fetchColumn();

    $Npaginas=ceil($total/$registros);

    $tabla.='
        <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
    ';

    if($total>=1 && $pagina<=$Npaginas){

    }else{

    }

    $tabla.='</tbody></table></div>';

