<?php
    $numberYears=4;
    $yearToDays=$numberYears*52*7;
    $yenumberOfTimesperDay=6;
    //echo $yearToDays; return;
    $rows=1;
    for($day=0; $day<=$yearToDays; $day++)
    {
        for($numberOfTimes = 1;$numberOfTimes<=$yenumberOfTimesperDay; $numberOfTimes++)
        {
            $date = new DateTime('2019-01-01 00:00:00');
            $date->modify("+$day day");
            $dateIns = $date->format('Y-m-d H:i:s');

            $rand1To10Products =  rand(1, 10);
            $typeMovement =  rand(1, 2);
            $amount =  rand(1, 100);
            $price =  rand(11, 28);

            $conexion = mysqli_connect("localhost", "root", "", "almacendb") or die("Problemas con la conexión");
            $sqls = "INSERT INTO movimiento (idmov, `productoid`, `usuarioid`, `tipomovimientoid`, `cantidad`, `precio`, `fecha`) VALUES 
            (NULL, '$rand1To10Products', '1', '$typeMovement', '$amount', '$price','$dateIns')";
        //  echo $sqls; return;
            mysqli_query($conexion, $sqls) or die("Problemas en el select" . mysqli_error($conexion));
        
            $rows++;
        }
    }
?>