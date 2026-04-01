<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';

require_login();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $userId = $_SESSION['user_id'];
    $query = "select * from tasks where id = $id And user_id = $userId";
    $result = mysqli_query($conn , $query);
    if(mysqli_num_rows($result) == 1){
        $task = mysqli_fetch_assoc($result);
    }else{
    redirect('../errors/404.php');
    }
}else{
    redirect('../errors/404.php');
}



?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Edit Task</h3>
                    <?php 
                    require_once "../errors/errors_success.php";
                    ?>
                <form action="update.php?id=<?php echo $task['id']; ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input class="form-control" name="title" value="<?php echo $task['title']; ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input class="form-control" name="description" value="<?php echo $task['description']; ?>" />
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-light" href="index.php">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
