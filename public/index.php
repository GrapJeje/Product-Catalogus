<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productcatalogus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require_once('../../../../config/php/config.php'); ?>

    <header>
        <h1>Productcatalogus</h1>
    </header>

    <div class="container">
        <!-- Productoverzicht -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Prijs (€)</th>
                    <th>Voorraad</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <?php
                require_once('../app/Http/Controllers/ProductsController.php');

                $controller = new ProductsController;
                $controller->showProducts();
            ?>
        </table>

        <!-- Formulier om producten toe te voegen -->
        <div class="form-section">
            <h2>Product toevoegen/bewerken</h2>
            <form action="../app/Http/Controllers/newProductController.php" method="post">
                <input type="hidden" name="product_id" placeholder="ID (voor bewerken)">
                <input type="text" name="product_name" placeholder="Naam van het product" required>
                <input type="text" name="product_description" placeholder="Beschrijving" required>
                <input type="number" name="product_price" placeholder="Prijs (€)" step="0.01" required>
                <input type="number" name="product_stock" placeholder="Voorraad" required>
                <button type="submit" name="action" value="add">Opslaan</button>
            </form>
        </div>
    </div>

    <?php require_once('../../../../config/php/footer.php'); ?>
</body>

</html>