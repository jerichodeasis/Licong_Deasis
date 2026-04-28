<?php
include 'auth.php';
include 'db.php';

if($_SESSION['role'] != 'buyer'){
    die("Access Denied");
}

$id = intval($_GET['id']);
$user_id = $_SESSION['id'];

$res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$p = mysqli_fetch_assoc($res);

if(!$p){
    die("Product not found");
}

mysqli_query($conn, "
    INSERT INTO orders(user_id, product_id, quantity, total_price)
    VALUES('$user_id', '$id', 1, '{$p['price']}')
");

echo "<script>
alert('Purchase successful!');
window.location='buyer.php';
</script>";
?>