<?php
class Orders extends Database
{

    public function addUser($user) {
        if(empty($user)) {
            return false;
        }
        foreach ($user as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO users ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        return $this->resId();
    }


    public function addOrder($order, $user) {
        if(empty($order) || empty($order)  ) {
            return false;
        }
        foreach ($order as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }
        foreach ($user as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO orders ($colum_sql) VALUES ($val_sql)";
        $this->query($query);

        return $this->resId();
    }


    public function addPurchases($id, $cart_catalog) {
        if(empty($cart_catalog)) {
            return false;
        }

        foreach ($cart_catalog as $purch) {
            $name = $purch['name'];
            $price = $purch['price'];
            $amount = $purch['cart_amount'];
            $query = "INSERT INTO purchases (order_id, product_name, price, amount) VALUES ('$id', '$name', '$price', '$amount')";
            $this->query($query);
        }
    }


    public function updateUser($id, $user)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($user as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE users SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }


    public function updateOrder($id, $order)
    {
        if(empty($id)) {
            return false;
        }

        $query = "SELECT price * amount
                  FROM purchases
                  WHERE order_id = '$id'";
        $total_cost = 0;
        $summ = $this->query($query);
        foreach ($summ as $column => $val) {
            $total_cost += $val['price * amount'];
        }
        $order->total_cost = $total_cost;
        foreach ($order as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE orders SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }


    public function updatePurchases($purchases)
    {
        if(empty($purchases)) {
            return false;
        }
        foreach ($purchases as $id => $amount) {
            $query = "UPDATE purchases SET amount = '$amount' WHERE id=$id";
            $this->query($query);
        }
    }


    public function delOrders($operations)
    {
        foreach ($operations as $key => $id) {
            $query = "DELETE FROM orders WHERE id = '$id'";
            $this->query($query);
            $this->delPurchases($operations, 'order_id');
        }
    }

    public function delPurchases($operations, $id)
    {
        foreach ($operations as $key => $id_oper) {
            $query = "DELETE FROM purchases WHERE $id = '$id_oper'";
            $this->query($query);
        }
    }


    public function getOrder($id, $type = 'id')
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT o.id, o.total_cost, o.e_mail, o.status_id, o.first_name, o.last_name, o.phone, o.url, s.name, s.color
                  FROM orders o 
                  LEFT JOIN statuses s 
                  ON o.status_id = s.id
                  WHERE o.$type = '$id' LIMIT 1";


        $this->query($query);
        return $this->result();
    }


    public function getOrders($status = null)
    {

        $status_filter = '';
        if(!is_null($status)) {
            $status_filter = "AND o.status_id = $status";
        }

        $query =
            "SELECT o.id, o.total_cost, o.e_mail, o.status_id, o.first_name, o.last_name, o.url, s.name, s.color
            FROM orders o 
            LEFT JOIN statuses s ON o.status_id = s.id
            WHERE 1 $status_filter
            ORDER BY o.id DESC";

        $this->query($query);
        return $this->results();
    }


    public function getStatuses($status = null)
    {

        $status_filter = '';
        if(!is_null($status)) {
            $status_filter = "AND id <> $status";
        }

        $query =
            "SELECT id, name
            FROM statuses 
            WHERE 1 $status_filter
            ORDER BY id";
        $this->query($query);
        return $this->results();
    }

    public function getPurchases($id)
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id, product_name, price, amount FROM purchases WHERE order_id = '$id'";
        $this->query($query);
        return $this->results();
    }

//    Вывод ошибки на незаполненные поля контактов клиента

    public function formError($order) {
        $er = '';
        if (empty($order->last_name)) {
            $er .= "- Имя ";
        }
        if (empty($order->first_name)) {
            $er .= "- Фамилия ";
        }
        if (empty($order->e_mail)) {
            $er .= "- Е-мейл ";
        }
        if (empty($order->phone)) {
            $er .= "- Телефон";
        }
        $error = 'Заказ не может быть отправлен. Заполните, пожалуйста, поля: ' . $er;
        return $error;
    }


}
