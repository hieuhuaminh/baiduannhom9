<?php
    function connectDB(){
        $host="mysql:host=localhost;dbname=duan1hieu;charset=utf8";
        $user = "root";
        $pass ="";
        
        $imagePath = "assets/images/img/anh1.jpg";
        try {
            $conn = new PDO($host,$user,$pass);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo $e -> getMessage();
        }
    }
    
?>