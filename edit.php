<?php include 'auth.php'; include 'db.php';
if($_SESSION['role']!='admin') die("Access Denied");

$id=$_GET['id'];
$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM products WHERE id=$id"));

if(isset($_POST['update'])){
mysqli_query($conn,"UPDATE products SET product_name='$_POST[name]',price='$_POST[price]',stock='$_POST[stock]' WHERE id=$id");
header("Location: products.php");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
<h2>Edit Product</h2>
<form method="post">
<input class="form-control mb-2" name="name" value="<?= $data['product_name'] ?>">
<input class="form-control mb-2" name="price" value="<?= $data['price'] ?>">
<input class="form-control mb-2" name="stock" value="<?= $data['stock'] ?>">
<button class="btn btn-primary" name="update">Update</button>
</form>
</div>