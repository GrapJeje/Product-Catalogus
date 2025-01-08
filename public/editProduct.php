<?php
require_once(__DIR__ . '../../app/Models/Products.php');

class EditProduct
{
    public $product;

    public function set($id)
    {
        if (isset($_GET['product_id'])) {
            $id = $_GET['product_id'];
        }

        $product = new Products($id);
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bewerken</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/editProductstyle.css">
</head>

<body>
    <header>
        <h1>Product Bewerken</h1>
    </header>

    <?php
    $editProduct = new EditProduct();
    if (isset($_GET['product_id'])) {
        $editProduct->set($_GET['product_id']);
    }
    ?>

    <div class="container">
        <!-- Formulier om product te bewerken -->
        <div class="form-section">
            <h2>Product Bewerken</h2>
            <form action="product_handler.php" method="post">
                <div class="form-group">
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $editProduct->getProduct()->id; ?>" placeholder="ID (voor bewerken)">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="product_name">Naam van het product</label>
                        <input type="text" name="product_name" id="product_name" value="<?php echo $editProduct->getProduct()->name; ?>" placeholder="Naam van het product" required>
                    </div>

                    <div class="form-group">
                        <label for="product_description">Beschrijving</label>
                        <input type="text" name="product_description" id="product_description" value="<?php echo $editProduct->getProduct()->description; ?>" placeholder="Beschrijving" required>
                    </div>
                </div>

                <div class="form-row">
                <div class="form-group">
                        <label for="product_price">Prijs (€)</label>
                        <input type="number" name="product_price" id="product_price" value="<?php echo $editProduct->getProduct()->price; ?>" placeholder="Prijs (€)" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="product_stock">Voorraad</label>
                        <input type="number" name="product_stock" id="product_stock" value="<?php echo $editProduct->getProduct()->stock; ?>" placeholder="Voorraad" required>
                    </div>
                </div>

                <button type="submit" name="action" value="edit">Bewerken</button>
            </form>
        </div>

        <div class="back-button">
            <a href="javascript:history.back()"><button type="button">Terug naar Overzicht</button></a>
        </div>
    </div>
</body>

</html>