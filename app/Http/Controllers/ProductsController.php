<?php 

require_once(__DIR__ . '/../../Models/Products.php');

class ProductsController
{
    public function showProducts()
    {
        $products = Products::getProducts();

        echo "<tbody>";

        if (!empty($products)) {
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>{$product['name']}</td>";
                echo "<td>{$product['description']}</td>";
                echo "<td>{$product['price']}</td>";
                echo "<td>{$product['stock']}</td>";

                echo "<td>";
                echo "<form method=\"POST\" action=\"../app/Http/Controllers/editProductController.php\" class=\"action-buttons-form\">";
                echo "<input type=\"hidden\" name=\"product_id\" value=\"{$product['id']}\">";
                echo "<button type=\"submit\" class=\"edit-button\">Bewerken</button>";
                echo "<button type=\"submit\" class=\"delete-button\">Verwijderen</button>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
            echo "</tbody>";
        } else {
            echo "</tbody>";
            echo "<tr><td colspan='5'>Geen producten gevonden!</td></tr>";
        }
    }
}