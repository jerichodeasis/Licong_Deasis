<?php 
include 'auth.php';
include 'db.php';

/* =========================
   ROLE CHECK
========================= */
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'buyer') {
    die("Access Denied");
}

/* =========================
   SEARCH HANDLING
========================= */
$search = $_GET['search'] ?? "";

if($search != ""){
    $search_safe = mysqli_real_escape_string($conn, $search);

    $res = mysqli_query(
        $conn,
        "SELECT * FROM products WHERE product_name LIKE '%$search_safe%'"
    );
} else {
    $res = mysqli_query($conn, "SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyer Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2 class="mb-3">Buyer Shop</h2>

    <!-- SEARCH BAR -->
    <form method="get" class="mb-3">

        <input class="form-control mb-2"
               name="search"
               placeholder="Search product..."
               value="<?= htmlspecialchars($search) ?>">

        <button class="btn btn-info w-100">Search</button>

    </form>

    <!-- STATUS MESSAGE -->
    <?php if($search == "") { ?>
        <p class="text-muted">Showing all products</p>
    <?php } ?>

    <!-- PRODUCTS -->
    <div class="row">

        <?php if(mysqli_num_rows($res) > 0){ ?>

            <?php while($r = mysqli_fetch_assoc($res)){ ?>

                <div class="col-md-4 mb-3">

                    <div class="card shadow-sm p-3">

                        <img src="uploads/<?= htmlspecialchars($r['image']) ?>"
                             class="img-fluid mb-2"
                             style="height:150px; object-fit:cover;">

                        <h5><?= htmlspecialchars($r['product_name']) ?></h5>

                        <p class="mb-1">
                            Price: ₱<?= htmlspecialchars($r['price']) ?>
                        </p>

                        <p class="mb-2">
                            Stock: <?= htmlspecialchars($r['stock']) ?>
                        </p>

                        <!-- BUY BUTTON -->
                        <a href="buy.php?id=<?= $r['id'] ?>"
                           class="btn btn-success w-100">
                            Buy Now
                        </a>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="alert alert-warning">
                No products found
            </div>

        <?php } ?>

    </div>

    <a href="my_orders.php" class="btn btn-primary mt-3">My Orders</a>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>

</div>

</body>
</html>