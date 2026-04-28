<?php include 'auth.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
<div class="card p-3">
<h3>Receipt</h3>
<p>User: <?= $_SESSION['user'] ?></p>
<p>Date: <?= date('Y-m-d') ?></p>
<button onclick="window.print()" class="btn btn-primary">Print</button>
</div>
</div>