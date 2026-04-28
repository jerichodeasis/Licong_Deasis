<?php
include 'auth.php';
include 'db.php';

if($_SESSION['role'] != 'buyer'){
    die("Access Denied");
}

$user_id = $_SESSION['id'];

$sql = "
SELECT o.*, p.product_name 
FROM orders o
JOIN products p ON o.product_id = p.id
WHERE o.user_id = $user_id
";

$res = mysqli_query($conn, $sql);

if(!$res){
    die("Database Error: " . mysqli_error($conn));
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h3>My Orders</h3>

<table class="table table-bordered mt-3">

<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Date</th>
</tr>

<?php while($r = mysqli_fetch_assoc($res)){ ?>
<tr>
    <td><?= htmlspecialchars($r['product_name']) ?></td>
    <td><?= $r['quantity'] ?></td>
    <td>₱<?= $r['total_price'] ?></td>
    <td><?= $r['order_date'] ?></td>
</tr>
<?php } ?>

</table>

</div>