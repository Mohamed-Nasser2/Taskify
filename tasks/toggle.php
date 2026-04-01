<?php

require_once "../inc/conn.php";
require_once "../inc/functions.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $user_id = $_SESSION['user_id'];

        $query = "select * from tasks where id = $id and user_id = $user_id";
        $result = mysqli_query($conn , $query);
        if(mysqli_num_rows($result) ==1){
            $task = mysqli_fetch_assoc($result);
            $old_status = $task['status'];
            if($old_status == "done"){
                $new_status = "pending";
            }else{
                $new_status = "done";
            }
            $query = "update tasks set status = '$new_status' , updated_at = now() where id=$id and user_id=$user_id";
            $result = mysqli_query($conn , $query);
            if($result){            
                $_SESSION['success'] = "Task Status Updated";
                redirect("index.php");
            }else{
                $_SESSION['errors'] = ['error while updating status task'];
                redirect("index.php");
            }
        }else{
                $_SESSION['errors'] = ['error while updating status task'];
                redirect("index.php");
        }
}else{
    redirect("../errors/404.php");
}