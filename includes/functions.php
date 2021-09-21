<?php
    session_start();
    require_once 'connection.php';

    function set_message($msg){
        if(!empty($msg)){
            $_SESSION['MSG']=$msg;
        }else{
            $msg="";
        }
    }

   function display_message(){
        if(isset($_SESSION['MSG'])){
            echo $_SESSION['MSG'];
            unset($_SESSION['MSG']);
        }
    }
   

    function user_data(){
        global $con;
        if(isset($_POST['btn_login'])){
            $username = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['senha']);
            $remember = isset($_POST['rem']);    

            if(empty($username) || empty($password)){
                $error_msg = '<div style="text-align: center;" class="alert alert-danger">Por favor preencha os campos</div>';
                set_message($error_msg );
            }
            else{
                $query = "SELECT * FROM usuario WHERE email='$username'";
                $result = mysqli_query($con,$query);

                if(mysqli_num_rows($result)){
                    while($row = mysqli_fetch_assoc($result)){
                        $username_db=$row['email'];
                        $password_db=$row['senha'];

                        if(sha1($password)==$password_db){
                            if($remember==true){                               
                                setcookie('USER_NAME',$username_db, time() + 86400 * 30);
                                setcookie('PASSWORD',$password_db, time() + 86400 * 30);
                            }

                            $_SESSION['email']=$username_db;
                            $_SESSION['senha']=$password_db;

                            header("Location:dashboard.php");
                        }
                        else{
                            $error_msg = '<div class="alert alert-danger">Senha inválidad</div>';
                            set_message($error_msg);
                        }

                    }
                }else{
                    $error_msg = '<div class="alert alert-danger">Nome de usuário inválido</div>';
                    set_message($error_msg );
                }
            }
        }
    }

?>