<?php
class OrdersAdmin extends CoreAdmin
{
    public function fetch()
    {
        $orders = new Orders();
        $request = new Request(); // подключаем модель Запрос

        if($request->method() == 'POST' && isset($_POST['delete'])) {
            $operations = $request->post('operations');
            $orders->delOrders($operations);
        }

        if(isset($_GET['status'])) {
            $status = (int)$_GET['status'];
        } else {
            $status = null;
        }
        $orders->getOrders($status);
        $all_orders = $orders->getOrders($status);

        $array_vars = array(
            'orders' => $all_orders,
            'name' => 'Заказы',
        );

        return $this->view->render('orders.html',$array_vars);

    }
}