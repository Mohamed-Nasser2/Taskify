<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';

require_login();
$userId = $_SESSION['user_id'];
$query = "select * from tasks where user_id = $userId order by id desc";
$result = mysqli_query($conn , $query);

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">My Tasks</h3>
      <div>
        <span class="me-2">Hello, <?php echo $_SESSION['user_name']; ?></span>
        <a class="btn btn-outline-danger btn-sm" href="../auth/logout.php">Logout</a>
      </div>
    </div>

    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <h5 class="mb-3">Add Task</h5>
        <form action="store.php" method="POST" class="row g-2">
          <div class="col-md-5">
            <input class="form-control" name="title" placeholder="Task title" />
          </div>
          <div class="col-md-5">
            <input class="form-control" name="description" placeholder="Short description" />
          </div>
          <div class="col-md-2">
            <button type="submit" name="submit" class="btn btn-primary w-100">Add</button>
          </div>
        </form>
      </div>
    </div>

    <div class="alert alert-danger d-none">Error here</div>
    <div class="alert alert-success d-none">Success here</div>
    <?php 
      require_once "../errors/errors_success.php";
    ?>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(mysqli_num_rows($result) > 0){
                $tasks = mysqli_fetch_all($result , MYSQLI_ASSOC); 
                foreach($tasks as $task){ ?>
                  <tr>
                    <td><?php echo $task['id']; ?></td>
                    <td><?php echo $task['title']; ?></td>
                    <td><?php echo $task['description']; ?></td>
                    <?php 
                      if($task['status'] == 'done'):
                    ?>
                    <td><span class="badge bg-success">Done</span></td>
                    <?php 
                      else :  
                    ?>
                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                    <?php endif ; ?>
                    <td class="text-end" style="display: flex; gap: 10px; justify-content: flex-end;">
                      <a class="btn btn-sm btn-<?php echo $task['status'] == 'done' ? 'warning' : 'success'; ?>" href="toggle.php?id=<?php echo $task['id']; ?>">
                        <?php echo $task['status'] == 'done' ? 'Make Pending' : 'Make Done'; ?>
                      </a>
                      <a class="btn btn-sm btn-secondary" href="edit.php?id=<?php echo $task['id']; ?>">Edit</a>
                      <form action="delete.php?id=<?php echo $task['id']; ?>" method="post">
                        <button type="submit" name="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
              <?php  }
              }else{ ?>
                <tr>
                  No Data Founded
                </tr>
              <?php }
              ?>
              
            
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</body>
</html>
