<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/homeModel.php';
class homeController{
    public $homeModel;
    function __construct(){
        $this ->homeModel=new homeModel();
    }
    function home(){
        $product = $this->homeModel->findImageProduct();
        require_once 'views/home.php';
    }
    function detailPro($id){
        $productOne=$this -> homeModel -> findProductById($id);
        require_once 'views/detailProduct.php';
    }
}
?>