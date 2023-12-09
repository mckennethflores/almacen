<?php

$functionName = $argv[1];
$arg1 = $argv[2];
$arg2 = $argv[3];



function your_php_function($arg1, $arg2) {

    $sum=$arg1+$arg2;
    $result = "$sum";

    return $result;
}
function loadData($numberYears, $numberOfTimesperDay) {
    $loadAllData="no";
    $semanas=52;
    $dias=7;
    //$numberYears=4;
    /* $yearToDays=$numberYears*52*7; */
    $yearToDays=$numberYears*$semanas*$dias;
    //$numberOfTimesperDay=6;
    //echo $yearToDays; return;
    $rows=1;
    for($day=0; $day<=$yearToDays; $day++)
    {
        for($numberOfTimes = 1;$numberOfTimes<=$numberOfTimesperDay; $numberOfTimes++)
        {
            $date = new DateTime('2023-01-01 00:00:00');
            $date->modify("+$day day");
            $dateIns = $date->format('Y-m-d H:i:s');

            $rand1To10Products =  rand(1, 3);
            $typeMovement =  1;
            $amount =  rand(60, 120);
            $price =  100;
            /* if($typeMovement == 1){

                $amount =  rand(90, 210);
            }else{
                $amount =  rand(60, 142);
            } */
            

          
            //
            

            $conexion = mysqli_connect("localhost", "root", "", "almacendb") or die("Problemas con la conexión");
            $sqls = "INSERT INTO movimiento (idmov, `productoid`, `usuarioid`, `tipomovimientoid`, `cantidad`, `precio`, `fecha`) VALUES 
            (NULL, '$rand1To10Products', '1', '2', '$amount', '$price','$dateIns')";
        //  echo $sqls; return;
            mysqli_query($conexion, $sqls) or die("Problemas en el select" . mysqli_error($conexion));
        
            $rows++;
        }
    }
    $loadAllData="si";
  /*   if($loadText==false){

        $loadAllData=true;
        
    }else{
        return "cargando ...";
    } */
    return $loadAllData;
    // Return the result
}

// Call the specified function with the provided arguments
$result = call_user_func($functionName, $arg1, $arg2);

// Print the result so Python can capture it
echo $result;
?>