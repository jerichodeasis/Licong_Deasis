<?php 
include 'auth.php'; 
include 'db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access Denied");
}

$uploadDir = "uploads/";

/* =======================
   ADD PRODUCT
======================= */
if(isset($_POST['add'])){

    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if(!empty($img)){
        move_uploaded_file($tmp, $uploadDir . $img);
    } else {
        $img = "default.png";
    }

    mysqli_query($conn, "
        INSERT INTO products(product_name, price, stock, image)
        VALUES('$name', '$price', '$stock', '$img')
    ");
}

/* =======================
   DELETE PRODUCT
======================= */
if(isset($_GET['delete'])){

    $id = intval($_GET['delete']);

    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

/* =======================
   FETCH PRODUCTS
======================= */
$res = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Admin Products</title>
</head>

<body>

<div class="container mt-4">

    <h2 class="mb-3">Product Management</h2>

    <!-- ADD FORM -->
    <div class="card p-3 mb-3 shadow-sm">

        <form method="post" enctype="multipart/form-data">

            <input class="form-control mb-2" name="name" placeholder="Product Name" required>

            <input class="form-control mb-2" name="price" placeholder="Price" required>

            <input class="form-control mb-2" name="stock" placeholder="Stock" required>

            <input class="form-control mb-2" type="file" name="image">

            <button class="btn btn-success w-100" name="add">
                Add Product
            </button>

        </form>

    </div>

    <!-- TABLE -->
    <table class="table table-bordered table-hover">

        <tr class="table-dark">
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($res)){ ?>
        <tr>

            <td><?= htmlspecialchars($r['product_name']) ?></td>

            <td>₱<?= htmlspecialchars($r['price']) ?></td>

            <td><?= htmlspecialchars($r['stock']) ?></td>

            <td>
                <img src="uploads/<?= htmlspecialchars($r['image']) ?>" width="60">
            </td>

            <td>
                <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="?delete=<?= $r['id'] ?>" 
                   onclick="return confirm('Delete this product?')"
                   class="btn btn-danger btn-sm">
                    Delete
                </a>
            </td>

        </tr>
        <?php } ?>

    </table>

</div>
<a class="btn btn-success mt-3" href="admin.php">Admin</a>
</body>
</html>