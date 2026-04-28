<?php
include 'auth.php';
include 'db.php';

if($_SESSION['role'] != 'admin') {
    die("Access Denied");
}

$res = mysqli_query($conn, "
    SELECT o.*, p.product_name, u.username
    FROM orders o
    JOIN products p ON o.product_id = p.id
    JOIN users u ON o.user_id = u.id
    ORDER BY o.order_date DESC
");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

    <h3>All Orders</h3>

    <table class="table table-bordered mt-3">
        <tr>
            <th>User</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($res)){ ?>
        <tr>
            <td><?= htmlspecialchars($r['username']) ?></td>
            <td><?= htmlspecialchars($r['product_name']) ?></td>
            <td><?= $r['quantity'] ?></td>
            <td>₱<?= $r['total_price'] ?></td>
            <td><?= $r['order_date'] ?></td>
        </tr>
        <?php } ?>

    </table>

</div>