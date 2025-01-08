<?php

class Products
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;

    public function __construct($id)
    {
        $this->id = $id;

        $products = $this::getProducts();

        if (isset($products[$id])) {
            $product = $products[$id];
            $this->name = $product['name'];
            $this->description = $product['description'];
            $this->price = $product['price'];
            $this->stock = $product['stock'];
        } else {
            throw new Exception("Product with ID $id not found.");
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function toCsv()
    {
        $this->id . "," . $this->name . "," . $this->description . "," . $this->price . "," . $this->stock;
    }

    public static function writeToCsv($id, $productsCsv)
    {
        $filePath = __DIR__ . '/../../data/products.csv';
        $lines = [];

        if (($file = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($file)) !== false) {
                $lines[] = ($data[0] === $id) ? str_getcsv($productsCsv) : $data;
            }
            fclose($file);
        }

        if (($file = fopen($filePath, 'w')) !== false) {
            foreach ($lines as $line) {
                fputcsv($file, $line);
            }
            fclose($file);
        } else {
            throw new Exception("Kan het bestand niet openen voor schrijven: {$filePath}");
        }
    }

    public static function getProducts()
    {
        $products = [];
        $file = fopen(__DIR__ . '/../../data/products.csv', 'r');

        if ($file !== false) {
            fgetcsv($file);

            while (($row = fgetcsv($file)) !== false) {
                $products[] = [
                    'id' => $row[0],
                    'name' => $row[1],
                    'description' => $row[2],
                    'price' => $row[3],
                    'stock' => $row[4],
                ];
            }

            fclose($file);
        } else {
            echo "<script>console.error('Het bestand \"products.csv\" kon niet worden geopend.');</script>";
        }
        return $products;
    }
}
