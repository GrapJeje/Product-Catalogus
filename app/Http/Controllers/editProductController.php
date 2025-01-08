<?php
    require_once(__DIR__ . '../../../../../../../config/php/config.php');
    require_once(__DIR__ . '/../../Models/Products.php');
    require_once(__DIR__ . '/../../../public/editProduct.php');

    $action = $_POST['action'];
    $id = $_POST['product_id'];

    if ($action == "edit") {
        $editProduct = new EditProduct();
        $editProduct->set($id);
    
        header("Location: ../../../public/editProduct.php?product_id=" . $id);
    } elseif ($action == "delete") {
        Products::deleteProduct($id);
        header("Location: ../../../public/index.php");
    } else {
        header("Location: ../../../public/index.php");
    }

    exit();
