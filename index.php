<?php
    session_start();
    require_once 'includes/functions.php';
    user_data();
    
    if($_SESSION['rem'] == true){
        header("location:dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cadastro</title>
    <link rel="stylesheet" href="/css/index.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="679342418578-clgf2bbh5kj55vcf28m3kk2o392cojvk.apps.googleusercontent.com" >
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <span>
                <?php
                 if(isset($_SESSION['MSG'])){
                    display_message();
                }
                if($_GET['msg']){
                        echo "<br><h3 style='text-align: center; color: red; font-size: 14px; font-weight: normal'>".$_GET['msg']."</h3>";  
                }
                
                ?>
            </span>
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Cadastro</button>
            </div>     

            <div class="social-icons">
                <img src="/img/fb.png" alt="">
                <img src="/img/tw.png" alt="">
                <img class="g-signin2" src="/img/gp.png" alt="" >
            </div>
            <form action="/validar_usuario.php" method="POST" id="login" class="input-group">
                <input type="email" name="email" class="input-field" placeholder="Email" required>
                <input type="password" name="senha" class="input-field" placeholder="Senha" required>              
                <lable><input type="checkbox" name="rem" class="remember-me"><span id="remember-me__label">Manter-se logado</span></lable>
                <button type="submit" class="submit-btn" name="btn_login">Logar-se</button>
            </form>
            <form action="/cadastro.php" method="POST" id="register" class="input-group">
                <input type="text" name="nome" class="input-field" placeholder="Nome" required>
                <input type="email" name="email" class="input-field" placeholder="Email" required>
                <input type="password" name="senha" class="input-field" placeholder="Senha" required>
                <input type="checkbox" name="termos" class="remember-me"><span id="remember-me__label">Concordo com os termos e condições</span>
                <button type="submit" class="submit-btn">Cadastrar-se</button>
            </form>
        </div>
    </div>

    <script>
        let x = document.getElementById("login")
        let y = document.getElementById("register")
        let z = document.getElementById("btn")

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login(){
            x.style.left = "40px";
            y.style.left = "450px";
            z.style.left = "0px";
        }

        login()
    </script>
    <script type="text/javascript">
	function onSignIn(googleUser) {
	  var profile = googleUser.getBasicProfile();


      if(profile){
          $.ajax({
                type: 'POST',
                url: 'login_pro.php',
                data: {id:profile.getId(), name:profile.getName(), email:profile.getEmail()}
            }).done(function(data){
                console.log(data);
                window.location.href = 'home.php';
            }).fail(function() { 
                alert( "Posting failed." );
            });
      }


    }
</script>
</body>
</html>