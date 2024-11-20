<?php

include 'db.php'; // Kết nối cơ sở dữ liệu
include 'header.php'; // Header của trang

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Truy vấn sản phẩm dựa trên ID
    $query = "SELECT p.*, c.name AS category_name 
              FROM products p 
              JOIN categories c ON p.category_id = c.id 
              WHERE p.id = $productId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        ?>
        <div class="product-detail">
            <!-- Ảnh sản phẩm -->
            <div class="product-image">
                <img src="assets/image/img/anh<?= htmlspecialchars($product['id']) ?>.jpg" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="product-info">
                <h1 class="product-name"><?= htmlspecialchars($product['name']) ?></h1>
                <p><strong>Danh mục:</strong> <?= htmlspecialchars($product['category_name']) ?></p>
                <p><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($product['description'])) ?></p>
                <p><strong>Giá:</strong> <span class="price"><?= number_format($product['price'], 0, ',', '.') ?> đ</span></p>
                <p><strong>Tồn kho:</strong> <?= $product['stock'] ?></p>
                <form action="addToCart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" name="quantity" min="1" max="<?= $product['stock'] ?>" value="1">
                    <div class="buttons">
                        <button type="submit" class="btn add-to-cart">Thêm vào giỏ hàng</button>
                        <button type="button" class="btn buy-now">Mua ngay</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo '<p>Sản phẩm không tồn tại.</p>';
    }
} else {
    echo '<p>ID sản phẩm không hợp lệ.</p>';
}

include 'footer.php'; 
?>
