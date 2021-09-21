<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validando usuário...</title>
    </head>
    <body>
        <?php
            $servername = "sql206.epizy.com";
            $username = "epiz_28882527";
            $password = "2jpstv39";
            $dbname = "epiz_28882527_projeto_bd";

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }            
            $sql = "UPDATE agendamento SET status_agendamento = 'pago', confirmacao_pagamento = '1' WHERE id='".$_GET['id']."'"; 
                        
            if ($conn->query($sql) === TRUE) {
                header('Location: dashboard.php');
                die();
            } else {
                echo "<br/>Error: " . $sql . "<br>" .$conn->error;
            }
        ?>
    </body>
</html>
