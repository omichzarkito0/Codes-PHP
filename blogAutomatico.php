<?php

$id = $_REQUEST['id'];

$conexion = mysqli_connect( "localhost", "#", "#" ) or die ("No se ha podido conectar al servidor de Base de datos");

$db = mysqli_select_db( $conexion, "#" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );


if($id != "new post"){
    $nombre = $_REQUEST["nombre"];
    $correo = $_REQUEST["correo"];

    $sql = "INSERT INTO subs_debug (id) values (1)";
    $resultado = mysqli_query( $conexion, $sql );

    $sql = "INSERT INTO subs (nombre, correo) values ('$nombre', '$correo')";
    $resultado = mysqli_query( $conexion, $sql );
}else{
    $nombre = $_REQUEST["nombre"];
    $link = $_REQUEST["link"];
    $ext = $_REQUEST["ext"];
    $ext2 = $_REQUEST["ext2"];

    $sql = "INSERT INTO post_debug (id) values (1)";
    $resultado = mysqli_query( $conexion, $sql );
    
    $sql = "UPDATE Post SET Nombre = '$nombre', link = '$link', ext = '$ext', ext2 = '$ext2' WHERE id = 1";
    $resultado = mysqli_query( $conexion, $sql );

    
    $sql = "SELECT *FROM subs";
    $resultado = mysqli_query( $conexion, $sql );
    
    $postNombre = $nombre;
    $url = $link;
    $urlImage = $ext;
    $hora = $ext2;
    $asunto = $postNombre;

    while($row = mysqli_fetch_array($resultado)){

    $nombre = $row["nombre"];
    $correo = $row["correo"];
    $destino = $correo;
    $header="From: Kiitos <>\r\n"."X-Mailer: PHP5\n"."MIME-Version: 1.0\n"."Content-type: text/html; charset=utf-8 \r\n";
    $mensaje = "
        <div style='font-family:sans-serif;padding:10px;color:black;'>
        <div style='padding:10px;background:black;'>
            <h2 style='color:white;text-align:center;'>¡Nuevo Post en <span style='color: #DB4476'>Kiitos.com.mx</span>!</h2>
        </div>
        <div style='padding:5px;margin:30px 0;'>
            <p>Hola $nombre,</p>
            <p>Queremos mostrarte el nuevo post que hemos subido, hechale un vistazo y dejanos tu comentario.</p>
            
            <br>
            <center><img src='$urlImage' width='100%' max-width='200px'/></center><br>
            <p style='text-align:center;'>$postNombre</p>
            <p style='text-align:center;'>Fecha de subida: $hora</p>
            <center><a href='$url'><button style='underline:none; padding: 20px 40px; color: white; background: #DB4476; cursor: pointer; border-radius: 10px; font-size: 1.3em;'>Ir al Post (Clic Aquí)</button></a></center>
        </div>
        <div style='padding:10px;background:black;'>
            <h2 style='color:white;text-align:center;'>Gracias por estar suscrito en <span style='color: #DB4476'>Kiitos.com.mx - Blog</span></h2>
        </div>
    </div>
    ";
    mail($destino, $asunto, $mensaje, $header);

    }
}

?>

<?php
/*
    $postNombre = $nombre;
    $url = $link;
    $urlImage = $ext;
    $hora = $ext2;
    $nombre = $row["nombre"];
    $correo = $row["correo"];
    $asunto = $postNombre;
    $destino = $correo;
    $header="From: Kiitos <>\r\n"."X-Mailer: PHP5\n"."MIME-Version: 1.0\n"."Content-type: text/html; charset=iso-8859-1 \r\n";
    $mensaje = "
        <div style='font-family:sans-serif;padding:10px;color:black;'>
        <div style='padding:10px;background:black;'>
            <h2 style='color:white;text-align:center;'>¡Nuevo Post en <span style='color: #DB4476'>Kiitos.com.mx</span>!</h2>
        </div>
        <div style='padding:5px;margin:30px 0;'>
            <p>Hola $nombre,</p>
            <p>Queremos mostrarte el nuevo post que hemos subido, hechale un vistazo y dejanos tu comentario.</p>
            
            <br>
            <img src='$urlImage'/><br>
            <p style='text-align:center;'>$postNombre</p>
            <p style='text-align:center;'>Hora de subida: $hora</p>
            <center><button style='underline:none; padding: 20px 40px; color: white; background: #DB4476; cursor: pointer; border-radius: 10px; font-size: 1.3em;'>Ir al Post (Clic Aquí)</button></center>
        </div>
        <div style='padding:10px;background:black;'>
            <h2 style='color:white;text-align:center;'>Gracias por estar suscrito en <span style='color: #DB4476'>Kiitos.com.mx - Blog</span></h2>
        </div>
    </div>
    ";
    echo $mensaje;
    mail($destino, $asunto, $mensaje, $header);
    */
?>
