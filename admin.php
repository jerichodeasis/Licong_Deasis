<?php include 'auth.php'; include 'db.php';
if($_SESSION['role']!='admin') die("Access Denied");

$users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as c FROM users"));
$products=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as c FROM products"));
$orders=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as c FROM orders"));
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
<h2>Admin Dashboard</h2>

<div class="row">
<div class="col-md-4"><div class="card p-3">Users: <?= $users['c'] ?></div></div>
<div class="col-md-4"><div class="card p-3">Products: <?= $products['c'] ?></div></div>
<div class="col-md-4"><div class="card p-3">Orders: <?= $orders['c'] ?></div></div>
</div>

<a class="btn btn-success mt-3" href="products.php">Manage Products</a>
<a class="btn btn-info mt-3" href="sales.php">Sales Chart</a>
<a class="btn btn-danger mt-3" href="logout.php">Logout</a>
</div>