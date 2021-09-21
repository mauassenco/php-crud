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
    <link rel="stylesheet" href="/css/index.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <h1 style="text-align: center">Cadastro</h1>
            <?php           
                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $senha = sha1($_POST["senha"]);  
                $termos = $_POST["termos"];  
                
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

                $sql = "INSERT INTO usuario (nome, email, senha) VALUES ('".$nome."', '".$email."', '".$senha."')";

                 if ($conn->query($sql) === TRUE){
                    if($termos == true) {
                        $_SESSION["estalogado"]=true;
                        $_SESSION["nome"] = $nome; 
                        $_SESSION['email'] = $email;
                        $_SESSION['senha'] = $senha;                    
                        header('Location: dashboard.php');
                        exit;                   
                    }else{                        
                        header('Location: index.php/?msg=favor aceitar os termos de uso');
                    }
                  
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }                
                $conn->close();
            ?>
        </div>
    </div>
    
</body>
</html>