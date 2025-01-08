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

        $product = self::getProductById($id);

        if ($product) {
            $this->name = $product['name'];
            $this->description = $product['description'];
            $this->price = $product['price'];
            $this->stock = $product['stock'];
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
        return $this->id . "," . $this->name . "," . $this->description . "," . $this->price . "," . $this->stock;
    }

    public static function getNewId()
    {
        $products = self::getProducts();
        $id = 0;

        foreach ($products as $product) {
            if ($product['id'] > $id) {
                $id = $product['id'];
            }
        }

        return $id + 1;
    }

    public static function getProductById($id)
    {
        $products = self::getProducts();

        foreach ($products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }

        return null;
    }

    public static function deleteProduct($id)
    {
        $products = self::getProducts();

        $products = array_filter($products, fn($product) => $product['id'] !== $id);

        if (count($products) === count(self::getProducts())) {
            throw new Exception("Product met ID {$id} niet gevonden.");
        }

        self::writeToCsvb($products);

        return true;
    }

    public static function writeToCsvb($products)
    {
        $filePath = __DIR__ . '/../../data/products.csv';

        if (($file = fopen($filePath, 'w')) !== false) {
            fputcsv($file, ['id', 'name', 'description', 'price', 'stock']);

            foreach ($products as $product) {
                fputcsv($file, $product);
            }

            fclose($file);
        } else {
            throw new Exception("Kan het bestand \"products.csv\" niet openen voor schrijven.");
        }
    }

    public static function writeToCsv($id, $productsCsv)
    {
        $filePath = __DIR__ . '/../../data/products.csv';
        $lines = [];
        $productFound = false;

        if (($file = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($file)) !== false) {
                $lines[] = ($data[0] === $id) ? str_getcsv($productsCsv) : $data;
                $productFound = $productFound || ($data[0] === $id);
            }
            fclose($file);
        }

        if (!$productFound) $lines[] = str_getcsv($productsCsv);

        if (($file = fopen($filePath, 'w')) !== false) {
            foreach ($lines as $line) fputcsv($file, $line);
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
