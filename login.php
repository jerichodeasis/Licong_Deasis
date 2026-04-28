<?php 
include 'db.php';

$error = "";

if(isset($_POST['login'])){

    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");

    $r = mysqli_fetch_assoc($q);

    if($r && password_verify($p, $r['password'])){

        $_SESSION['id'] = $r['id'];
        $_SESSION['user'] = $r['username'];
        $_SESSION['role'] = $r['role'];

        header("Location: " . $r['role'] . ".php");
        exit();

    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Login</title>
</head>
<body>

<div class="container mt-5 col-md-4">

    <div class="card p-4 shadow">

        <h3 class="text-center">Login</h3>

        <form method="post">

            <input class="form-control mb-2" name="username" placeholder="Username" required>

            <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>

            <button class="btn btn-success w-100" name="login">Login</button>

        </form>

        <a href="register.php" class="btn btn-primary w-100 mt-2">Register</a>

        <div class="text-danger mt-2 text-center">
            <?= $error ?>
        </div>

    </div>

</div>

</body>
</html>