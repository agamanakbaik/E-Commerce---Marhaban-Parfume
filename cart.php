<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Keranjang kosong. Silakan tambahkan produk.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT products.name, products.price, products.image, cart.quantity 
          FROM cart 
          JOIN products ON cart.product_id = products.id 
          WHERE cart.user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
</head>
<body>

<h2>Keranjang Belanja</h2>
<div class="cart-list">
    <?php
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
    ?>
        <div class="cart-item">
            <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p>Harga: Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
            <p>Jumlah: <?php echo $row['quantity']; ?></p>
            <p>Subtotal: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></p>
        </div>
    <?php } ?>
</div>

<h3>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></h3>

<a href="checkout.php">Checkout</a>

</body>
</html>