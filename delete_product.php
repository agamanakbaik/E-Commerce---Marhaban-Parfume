<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id && is_numeric($id)) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "delete_failed";
        }

        $stmt->close();
    } else {
        echo "invalid_id";
    }
} else {
    echo "invalid_method";
}
?>
