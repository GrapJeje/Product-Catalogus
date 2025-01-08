<?php
    require_once(__DIR__ . '../../../../../../../config/php/config.php');
    require_once(__DIR__ . '/../../Models/Products.php');
    require_once(__DIR__ . '/../../../public/editProduct.php');

    $id = $_POST['product_id'];

    $editProduct = new EditProduct();
    $editProduct->set($id);

    header("Location: ../../../public/editProduct.php?product_id=" . $id);
    exit;
?>
