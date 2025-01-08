<?php 

require_once(__DIR__ . '/../../Models/Products.php');

$id = Products::getNewId();
$name = $_POST["product_name"];
$description = $_POST["product_description"];
$price = $_POST["product_price"];
$stock = $_POST["product_stock"];

$product = new Products($id);
$product->setName($name);
$product->setDescription($description);
$product->setPrice($price);
$product->setStock($stock);

Products::writeToCsv($id, $product->toCsv());
header("Location: ../../../public/index.php");

exit();