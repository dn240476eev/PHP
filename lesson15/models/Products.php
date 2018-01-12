<?php
class Products extends Database
{
    /*public function __construct()
    {
        parent::__construct();
    }*/

    public function addProduct($product, $parent_id)
    {
        print_r($product);
        echo "<br>";
        echo "<br>";
        echo "<br>";
        print_r($parent_id);
        if(empty($product)) {
            return false;
        }
        foreach ($product as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);
//        print_r($val_sql);
        $query = "INSERT INTO products ($colum_sql) VALUES ($val_sql)";
//        echo ($query);
//        die();
        $this->query($query);
        $res = $this->resId();
//        print_r($res);
        $query = "INSERT INTO products_categories (product_id, category_id) VALUES ('$res', '$parent_id')";
////        echo ($query);
////        die();
        $this->query($query);
        return $res;
    }

    public function getProduct($id, $field)
    {
//        print_r($id);
//        print_r($field);
        if(empty($id)) {
            return false;
        }
        $prod = 'p.'.$field;
//        print_r($prod);
        $query = "SELECT pc.category_id, p.id, p.name, p.price, p.amount, p.description, p.url, p.visible, p.hit, p.created_at, i.file_name
                  FROM products p 
                  LEFT JOIN images i 
                  ON i.product_id = p.id
                  LEFT JOIN products_categories pc 
                  ON pc.product_id = p.id 
                  WHERE $prod = '$id' LIMIT 1";
//        $query = "SELECT id,name, price, amount, description, url, visible, hit FROM products WHERE id = $id LIMIT 1";
        $this->query($query);
//        print_r($this->result());
        return $this->result();
    }

    public function getProducts()
    {
        $query =
            "SELECT p.id, p.name, p.price, p.amount, p.description, p.url, p.visible, p.hit, p.created_at, i.file_name, pc.category_id 
            FROM products p 
            LEFT JOIN images i 
            ON i.product_id = p.id
            LEFT JOIN products_categories pc 
            ON pc.product_id = p.id
            ORDER BY pc.category_id";
//        $query = "SELECT p.id, p.name, p.price, p.amount, p.description, p.url, p.visible, p.hit, i.file_name
// FROM products p LEFT JOIN images i ON i.product_id = p.id";

        $this->query($query);
//        print_r($this->results());
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
////        echo ($query);
////        die();
            $this->query($query);
        }

        return $id;
    }

}
