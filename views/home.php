<?php
include 'db.php';
include 'header.php';
?>

<div class="banner">
    <img src="https://quaquenambo.vn/wp-content/uploads/2022/11/banh-keo-orion-1-scaled.jpg" alt="Banner Image">
</div>

<div class="content">
<?php
$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = $conn->query($categoriesQuery);
if ($categoriesResult->num_rows > 0) {
    while ($category = $categoriesResult->fetch_assoc()) {
        ?>
        <div class="section">
            <h2><?= htmlspecialchars($category['name']) ?></h2>
            <div class="product-grid">
                <?php 
                $productsQuery = "SELECT * FROM products WHERE category_id = " . intval($category['id']);
                $productsResult = $conn->query($productsQuery);

                if ($productsResult->num_rows > 0) {
                    while ($product = $productsResult->fetch_assoc()) {
                        ?>
                        <div class="product-item">
                        
                            <a href="detailProduct.php?id=<?= urlencode($product['id']) ?>">
                                <img src="assets/image/img/anh<?= htmlspecialchars($product['id']) ?>.jpg" 
                                     alt="<?= htmlspecialchars($product['name']) ?>">
                            </a>
                            <h3 class="name-pro">
    <a href="detailProduct.php?id=<?= urlencode($product['id']) ?>">
        <?= htmlspecialchars(ucfirst(strtolower($product['name']))) ?>
    </a>
</h3>

                            <p class="price">
                                <?= htmlspecialchars(number_format($product['price'], 0, ',', '.')) ?> đ
                            </p>
                            <a href="index.php?act=detailpro&id=<?= urlencode($product['id']) ?>" class="view-more">
                                Xem chi tiết
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>Không có sản phẩm nào trong danh mục này.</p>';
                }
                ?>
            </div>
        </div>
        <?php
    }
} else {
    echo '<p>Không có danh mục nào.</p>';
}
?>

</div>

<?php
include 'footer.php';
?>