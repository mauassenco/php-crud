<?php
    $servername = "sql206.epizy.com";
    $username = "epiz_28882527";
    $password = "2jpstv39";
    $dbname = "epiz_28882527_projeto_bd"; 

    $con = mysqli_connect($servername,$username,$password,$dbname);
    if(!$con){
        die(mysqli_errno($con));
    }

?>