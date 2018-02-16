<?php
class Categories extends Database
{

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

        $query = "INSERT INTO categories ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        return $this->resId();
    }


    public function getCategory($id, $field)
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id, name, description, url, visible, image, parent_id FROM categories WHERE $field = '$id' LIMIT 1";
        $this->query($query);
        return $this->result();
    }


    public function getCategories()
    {
        $query = "SELECT id, name, description, url, visible, image, parent_id FROM categories ORDER BY  id DESC";
        $this->query($query);
        return $this->results();
    }


    public function getChildren($category_id = 0)
    {
        if(!empty($category_id)) {
            $query = "SELECT id, parent_id FROM categories WHERE parent_id = $category_id";
            $this->query($query);
        }
        return $this->results();
    }


//Дерево категорий

    public function GetCategoriesTree($parent_id=0)
    {
        $results=array();
        $categories = $this->getCategories();
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
        return $results;
    }


//id категории в products Мой вариант

    public function GetCategoriesId($id)
    {
        $results=array();
        $results[]=$id;

        if(!empty($id)) {
            $query = "SELECT id, parent_id FROM categories WHERE parent_id = $id";
            $this->query($query);
        }
        $categories = $this->results();
        foreach ($categories as $category) {
            $results[] = $category['id'];
        }

        return $results;
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


    public function delCategory($id, $type = 'id')
    {
        if(empty($id)) {
            return false;
        }
        $query = "DELETE FROM categories WHERE id = '$id' LIMIT 1";
        $this->query($query);
    }


    public function operatCategories ($name_operation, $operation)
    {
        foreach ($operation as $key => $id) {
            if ($name_operation == 1) {
                $query = "UPDATE categories SET visible = 1 WHERE id=$id";
                $this->query($query);
            } elseif ($name_operation == 2) {
                $query = "UPDATE categories SET visible = 0 WHERE id=$id";
                $this->query($query);
            } elseif ($name_operation == 3) {
                $this->delCategory($id, 'id');
            }
        }
    }


}