<?php


	session_start();

	$_SESSION["id"] = $_POST["id"];
	$_SESSION["name"] = $_POST["name"];
	$_SESSION["email"] = $_POST["email"];

    $servername = "sql206.epizy.com";
    $username = "epiz_28882527";
    $password = "2jpstv39";
    $dbname = "epiz_28882527_projeto_bd";        
        
    // Create connection
   	$mysqli = new mysqli($servername, $username, $password, $dbname);


	$sql = "SELECT * FROM usuario WHERE email='".$_POST["email"]."'";
	$result = $mysqli->query($sql);


	if(!empty($result->fetch_assoc())){
		$sql2 = "UPDATE usuario SET google_id='".$_POST["id"]."' WHERE email='".$_POST["email"]."'";
	}else{
		$sql2 = "INSERT INTO usuario (name, email, google_id) VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["id"]."')";
	}


	$mysqli->query($sql2);


	echo "Updated Successful";
?>