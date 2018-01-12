<?php
class Categories extends Database
{
    /*public function __construct()
    {
        parent::__construct();
    }*/
    public $results;

    public function addCategory($category)
    {
        if(empty($category)) {
            return false;
        }
        foreach ($category as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);
//        print_r($val_sql);

        $query = "INSERT INTO categories ($colum_sql) VALUES ($val_sql)";
//        echo ($query);
//        die();
        $this->query($query);
        return $this->resId();
    }


    public function getCategory($id, $field)
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id, name, description, url, visible, image, parent_id FROM categories WHERE $field = '$id' LIMIT 1";
//        echo ($query);
//        die();
        $this->query($query);
        return $this->result();
    }


//    public function getCategory($id)
//    {
//        if(empty($id)) {
//            return false;
//        }
//        $query = "SELECT id, name, description, url, visible, image, parent_id FROM categories WHERE id = $id LIMIT 1";
//        $this->query($query);
//        return $this->result();
//    }

    public function getCategories()
    {
        $query = "SELECT id, name, description, url, visible, image, parent_id FROM categories ORDER BY parent_id";
        $this->query($query);
//        print_r($this->results());
        return $this->results();

    }


//Дерево категорий


    public function GetCategoriesTree($parent_id=0)
    {
        $results=array();
        $categories = $this->getCategories();
//        print_r($categories);
        if ($categories) {
            foreach ($categories as $category) {
                if ($category['parent_id'] == $parent_id && $category['visible']) {
                    if ($category['id'] != $parent_id) {
                        $subcategories = $this->GetCategoriesTree($category['id']);
                        if(!empty($subcategories))
                            $category['subcategories'] = $subcategories ;
                    };
                    $results[]=$category;
                    unset($category);
                }
            }
        }
//        print_r($results);
        return $results;
    }


    public function makeCategories($categories)
    {
//        $categories = $this->GetCategoriesTree();
        if($categories) { // проверка лишней не бывает
            echo "<ul>";
            foreach ($categories as $category) {
                if($category['visible']) { //важная проверка, которая позволит выводит только включенные категории на сайте
                    echo "<li><input type=\"checkbox\" name=\"but\" id=\"".$category['id']."\">
                <label for=\"".$category['id']."\" class=\"label\"><a href='#'>".$category['name']."</a>";
                    if(!empty($category['subcategories'])) {
                        // проверяем есть ли подкатегории и вызываем заново функцию для вывода
                        echo "<span>></span></label>";
                        $this->makeCategories($category['subcategories']); // передаем в функцию уже массив обьектов покатегорий
                    }
//                    print_r($category['subcategories']);
                    echo "</li>";
                }
            }
            echo "</ul>";
        }
    }

//Дерево категорий END




    public function updateCategory($id, $category)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($category as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE categories SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }

}