<?php
class Products extends Database
{

    public function addProduct($product, $parent_id)
    {
        if(empty($product)) {
            return false;
        }
        foreach ($product as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);
        $query = "INSERT INTO products ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        $res = $this->resId();
        $query = "INSERT INTO products_categories (product_id, category_id) VALUES ('$res', '$parent_id')";
        $this->query($query);
        return $res;
    }

    public function getProduct($id, $type = 'id')
    {
        if(empty($id)) {
            return false;
        }
        $prod = 'p.'.$type;
        $query = "SELECT pc.category_id, p.id, p.name, p.price, p.amount, p.description, p.url, p.visible, p.hit, p.created_at, i.file_name
                  FROM products p 
                  LEFT JOIN images i 
                  ON i.product_id = p.id
                  LEFT JOIN products_categories pc 
                  ON pc.product_id = p.id 
                  WHERE $prod = '$id' LIMIT 1";
        $this->query($query);
        return $this->result();
    }

    public function getProducts($filter = array())
    {
        $hit = '';
        $visible = '';
        $amount = '';
        $cat_filter = '';

        if(!empty($filter['hit'])) {
            $hit = "AND p.hit = 1";
        }

        if(!empty($filter['visible'])) {
            $visible = "AND p.visible = 1";
        }

        if(!empty($filter['amount'])) {
            $amount = "AND p.amount > 0";
        }

        if(!empty($filter['cat_id'])) {
            $val_sql = implode(', ',$filter['cat_id']);
            $cat_filter = "AND pc.category_id IN ($val_sql)";
        }

        $query =
            "SELECT p.id, p.name, p.price, p.amount, p.description, p.url, p.visible, p.hit, p.created_at, i.file_name, pc.category_id
            FROM products p
            LEFT JOIN images i
            ON i.product_id = p.id
            LEFT JOIN products_categories pc ON pc.product_id = p.id
            WHERE 1 $cat_filter $hit $visible $amount 
            ORDER BY p.id DESC";

        $this->query($query);
        return $this->results();
    }

    public function updateProduct($id, $product, $parent_id)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($product as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE products SET $colum_sql WHERE id=$id";
        $this->query($query);

        $query = "SELECT $parent_id FROM products_categories WHERE product_id=$id LIMIT 1";
        $this->query($query);
        $parent = $this->result();

        if (isset($parent)) {
            $query = "UPDATE products_categories SET category_id = '$parent_id' WHERE product_id=$id";
            $this->query($query);
        } else  {
            $query = "INSERT INTO products_categories (product_id, category_id) VALUES ('$id', '$parent_id')";
            $this->query($query);
        }

        return $id;
    }

    public function delProduct($id, $type = 'id')
    {
        if(empty($id)) {
            return false;
        }
        $query = "DELETE FROM products WHERE id = '$id' LIMIT 1";
        $this->query($query);
        $query = "DELETE FROM products_categories WHERE product_id = '$id' LIMIT 1";
        $this->query($query);
    }

    public function operatProducts($name_operation, $operation)
    {
        foreach ($operation as $key => $id) {
            if ($name_operation == 1) {
                $query = "UPDATE products SET visible = 1 WHERE id=$id";
                $this->query($query);
            } elseif ($name_operation == 2) {
                $query = "UPDATE products SET visible = 0 WHERE id=$id";
                $this->query($query);
            } elseif ($name_operation == 3) {
                $this->delProduct($id, 'id');
            }
        }
    }

    public function getCsv()
    {
        $query =
            "SELECT c.name AS name_c, p.name, p.visible, p.price, p.amount, i.file_name, p.description
            FROM products p
            LEFT JOIN images i
            ON i.product_id = p.id
            LEFT JOIN products_categories pc
            ON pc.product_id = p.id
            LEFT JOIN categories c
            ON c.id = pc.category_id
            WHERE pc.product_id = p.id 
            ORDER BY pc.category_id, p.name";

        $results = $this->query($query);
        $fp = fopen('../file.csv', 'w');
        fwrite($fp,b"\xEF\xBB\xBF" );
        fwrite($fp,"Категория;Имя;Активность;Цена;Количество;Фото;Описание\n" );

        foreach ($results as $row) {
            fputcsv($fp, $row, ';');
        }

        fclose($fp);
        $file = '../file.csv';
        $this->file_force_download($file);
    }

    public function getXml()
    {
        $query =
            "SELECT c.name AS name_c, p.id, p.name, p.visible, p.price, p.amount, i.file_name, p.description, p.url
            FROM products p
            LEFT JOIN images i
            ON i.product_id = p.id
            LEFT JOIN products_categories pc
            ON pc.product_id = p.id
            LEFT JOIN categories c
            ON c.id = pc.category_id
            WHERE pc.product_id = p.id AND p.visible
            ORDER BY pc.category_id, p.name";
        $this->query($query);
        return $this->results();
    }

    public function getXml2()
    {
        $root_url = $_SERVER['DOCUMENT_ROOT'];

        $doc = new DOMDocument('1.0');

        $catalog = $doc->createElement('catalog');
        $doc->appendChild($catalog);

        $date = $doc->createElement('date', date('Y-m-d H:i'));
        $catalog->appendChild($date);

        $shop = $doc->createElement("shop");
        $catalog->appendChild($shop);

        $name = $doc->createElement("name", "Internet shop with TWIG");
        $shop->appendChild($name);

        $company = $doc->createElement("company", "IMT");
        $shop->appendChild($company);

        $url = $doc->createElement("url", $root_url);
        $shop->appendChild($url);

        // Товары

        $products = $doc->createElement("products");
        $shop->appendChild($products);

        $products_xml = $this->getXml();
        foreach($products_xml as $product)
        {
            $id = $product['id'];
            $name_c = htmlspecialchars($product['name_c']);
            $name = htmlspecialchars($product['name']);
            $description = htmlspecialchars(strip_tags($product['description']));
            $visible = $product['visible'];
            $amount = $product['amount'];
            $file_name = $product['file_name'];
            $url = $root_url.'/product/'.$product['url'];

            $product = $doc->createElement("product$id");
            $products->appendChild($product);

            $category_name = $doc->createElement("category_name", $name_c);
            $product->appendChild($category_name);

            $name = $doc->createElement("product_name", $name);
            $product->appendChild($name);

            $visible = $doc->createElement("visible", $visible);
            $product->appendChild($visible);

            $amount = $doc->createElement("amount", $amount);
            $product->appendChild($amount);

            $file_name = $doc->createElement("file_name", $file_name);
            $product->appendChild($file_name);

            $url = $doc->createElement("url", $url);
            $product->appendChild($url);

            $description = $doc->createElement("file_name", $description);
            $product->appendChild($description);
        }

        $doc->save("../feed.xml"); // Записано
        $file = '../feed.xml';
        $this->file_force_download($file);
    }

    public function file_force_download($file) {
        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }
    }

}
