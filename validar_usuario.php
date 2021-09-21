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
        $email = $_POST["email"];
        $senha = $_POST["senha"];        
        $nome = $_POST["nome"];  
        $remember = isset($_POST['rem']);       

        // Set session variable
        $_SESSION["estalogado"] = false;
        $_SESSION["email"] = $email;               
        $_SESSION["nome"] = $nome;  
        $_SESSION["senha"] = $senha;    
        $_SESSION["rem"] = $remember;    
            
          

        $servername = "sql206.epizy.com";
        $username = "epiz_28882527";
        $password = "2jpstv39";
        $dbname = "epiz_28882527_projeto_bd";        
         
         // Create connection
         $conn = new mysqli($servername, $username, $password, $dbname);

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }
         $sql = "SELECT * FROM usuario";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
            // comparando informações
                while($row = $result->fetch_assoc()) {
                    if($row["email"]==$email && $row["senha"]==sha1($senha)){
                        $_SESSION["estalogado"] = true;             
                    }
                }  
            } else {
                echo "0 resultados";
            }
            
            if($_SESSION["estalogado"]){                   
                header('Location: dashboard.php');
                exit;
            }else{
                echo "<h3 style='color: red; text-align: center'> email e/ou senha inválidos !</h3>";
                header('Location: index.php/?msg=email ou senha inválidos !');
            }
            
            $conn->close();
        ?>
</body>
</html>