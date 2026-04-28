<?php include 'auth.php'; include 'db.php';
if($_SESSION['role']!='admin') die("Access Denied");

$q=mysqli_query($conn,"SELECT products.product_name, SUM(orders.qty) as total FROM orders JOIN products ON products.id=orders.product_id GROUP BY orders.product_id");

$labels=[]; $data=[];
while($r=mysqli_fetch_assoc($q)){
$labels[]=$r['product_name'];
$data[]=$r['total'];
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
<h2>Sales Chart</h2>
<canvas id="chart"></canvas>
</div>
<a class="btn btn-success mt-3" href="admin.php">Admin</a>
<script>
new Chart(document.getElementById('chart'),{
type:'bar',
data:{
labels:<?= json_encode($labels) ?>,
datasets:[{label:'Sales',data:<?= json_encode($data) ?>}]
}
});
</script>