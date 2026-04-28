<?php include 'db.php';
if(isset($_POST['register'])){
$u=$_POST['username'];
$p=password_hash($_POST['password'],PASSWORD_DEFAULT);
$r=$_POST['role'];
mysqli_query($conn,"INSERT INTO users(username,password,role) VALUES('$u','$p','$r')");
header("Location: login.php");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5 col-md-4">
<h3>Register</h3>
<form method="post">
<input class="form-control mb-2" name="username">
<input class="form-control mb-2" type="password" name="password">
<select class="form-control mb-2" name="role">
<option value="buyer">Buyer</option>
<option value="admin">Admin</option>
</select>
<button class="btn btn-primary w-100" name="register">Register</button>
</form>
</div>