<?php
class OrderAdmin extends CoreAdmin
{
    public function fetch()
    {
        $orders = new Orders();

        $request = new Request(); // подключаем модель Запрос

        $order = new stdClass();
        $user = new stdClass();
        $purchase = new stdClass();

        $error = NULL;

        if($request->method() == 'POST') {
            $user->first_name = $request->post('first_name');
            $user->last_name = $request->post('last_name');
            $user->e_mail = $request->post('e-mail');
            $user->phone = $request->post('phone');

            if(!empty($user->first_name) && !empty($user->last_name) && !empty($user->e_mail)  && !empty($user->phone)) {
                $purchase->amount = $request->post('cart_item');

                $order = $user;
                $order->status_id = $request->post('status_id');

                if(isset($_POST['operations'])) {
                    $operations = $request->post('operations');
                    $orders->delPurchases($operations, 'id');
                }
                $orders->updateUser($request->post('user_id'), $user);
                $orders->updatePurchases($purchase->amount);
                $order_id = $orders->updateOrder($request->post('id'), $order);
                $order = $orders->getOrder($order_id, 'id');
                $purchases = $orders->getPurchases($order['id']);
            } else $error = $orders->formError($user);
        }

        if ($request->get('id','integer')) {
            $order = $orders->getOrder($request->get('id','integer'), 'id');
            $purchases = $orders->getPurchases($order['id']);
        }
        $status = $order['status_id'];
        $statuses = $orders->getStatuses($status);

        $array_vars = array(
            'order' => $order,
            'purchases' => $purchases,
            'statuses' => $statuses,
            'error' => $error,
        );

        return $this->view->render('order.html',$array_vars);
    }
}