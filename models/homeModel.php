<?php
class homeModel {
    public $conn;

    function __construct() {
        $this->conn = connectDB();
        // Kiểm tra xem kết nối có thành công không
        if (!$this->conn) {
            die("Lỗi kết nối cơ sở dữ liệu");
        }
    }

    function allProduct() {
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function top6Product() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function findImageProduct() {
        $sql = "SELECT p.id, p.name, p.price, pi.image FROM products as p JOIN product_images as pi ON p.id = pi.product_id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Tìm sản phẩm theo ID
    function findProductById($id) {
        // Sử dụng prepared statement để đảm bảo an toàn
        $sql = "SELECT p.id, p.name, p.price, p.quantity, p.description, pi.image FROM products as p JOIN product_images as pi ON p.id = pi.product_id WHERE p.id = :id"; // Đảm bảo tên cột đúng là `id`
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
