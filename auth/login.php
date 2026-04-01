<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Login</h3>

                <div class="alert alert-danger d-none">Error here</div>
                <div class="alert alert-success d-none">Success here</div>
                <?php 
                    session_start();
                    require_once "../errors/errors_success.php";
                ?>
                <form action="handle_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" name="email" placeholder="email@example.com" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" name="password" placeholder="******" type="password" />
                </div>

                <button type="submit" name="submit" class="btn btn-dark w-100">Login</button>
                </form>

                <p class="mt-3 mb-0">
                No account? <a href="register.php">Register</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
