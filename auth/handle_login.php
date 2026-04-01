<?php
require_once "../inc/conn.php";
require_once "../inc/functions.php";

if(isset($_POST['submit'])){

    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $_SESSION['email'] = $email;
    $errors=[];
    
    if(empty($email)){
        $errors[]="email is required";
    }elseif(!filter_var($email , FILTER_VALIDATE_EMAIL)){
        $errors[]="email must be email @";
    }

    if(empty($password)){
        $errors[]="password is required";
    }elseif(strlen($password) < 6){
        $errors[]="password must be more than 6 char";
    }

    if(empty($errors)){
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($conn , $query);
        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            //old password
            $old_password = $user['password'];
            $is_verify = password_verify($password , $old_password);
            if($is_verify){
                $_SESSION['user_id']= $user['id'];
                $_SESSION['user_name']= $user['name'];
                $_SESSION['success'] = "Login success , Welcome : ". $user['name'];
                redirect("../tasks/index.php");
            }else{
                $_SESSION['errors'] = ['email or password not correct'];
                redirect("login.php");
            }
        }else{
            $_SESSION['errors'] = ['email or password not correct'];
            redirect("login.php");
        }
        
    }else{
        $_SESSION['errors'] = $errors;
        redirect("login.php");
    }
}else{
    redirect("../errors/404.php");
}