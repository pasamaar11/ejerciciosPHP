
<?php
//Inicializamos el estado
    $energia = isset($_POST['energia']) ? (int)$_POST['energia'] : 100;
    $oro = isset($_POST['oro']) ? (int)$_POST['oro'] : 0;
    $historial = isset($_POST['historial']) ? unserialize($_POST['historial']) : [];
    $mensaje = "";

    if(isset($_POST['accion'])){//Comprobamos si existe accion en formulario
        //Si existe accion entonces...
        if($_POST['accion'] === 'explorar'){
            $energia -= 10;
            $oroGanado = rand(10,50);
            $oro += $oroGanado;
            $mensaje = "Exploras el blosque y encuentras $oroGanado monedas de oro.";
            //Ahora con esta forma de historiaañadimos texto al array
            $historial[] = "Exploración: +$oroGanado oro, -10 energía.";
        }
    }
?>
