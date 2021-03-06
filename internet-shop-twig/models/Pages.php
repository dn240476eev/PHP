<?php
class Pages extends Database
{

    public function addPage($page)
    {
        if(empty($page)) {
            return false;
        }
        foreach ($page as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO pages ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        return $this->resId();
    }

    public function getPage($id, $type = 'id')
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id, name, sort, description, url, visible FROM pages WHERE $type = '$id' LIMIT 1";
        $this->query($query);
        return $this->result();
    }

    public function getPages()
    {
        $query = "SELECT id, name, sort, description, url, visible FROM pages ORDER BY sort";
        $this->query($query);
        return $this->results();
    }

    public function updatePage($id, $page)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($page as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE pages SET $colum_sql WHERE id=$id ORDER BY sort";
        $this->query($query);
        return $id;
    }

    public function delPage($id, $type = 'id')
    {
        print_r($id);
        if(empty($id)) {
            return false;
        }
        $query = "DELETE FROM pages WHERE id = '$id' LIMIT 1";
        $this->query($query);
    }

    public function operatPages ($name_operation, $operation)
    {
        foreach ($operation as $key => $id) {
            if ($name_operation == 1) {
                $query = "UPDATE pages SET visible = 1 WHERE id=$id";
                $this->query($query);
            } elseif ($name_operation == 2) {
                $query = "UPDATE pages SET visible = 0 WHERE id=$id";
                $this->query($query);
            } elseif ($name_operation == 3) {
                $this->delPage($id, 'id');
            }
        }
    }


}