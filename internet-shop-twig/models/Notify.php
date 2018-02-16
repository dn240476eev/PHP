<?php
class Notify extends Database
{

    public function email($data) {
        if(empty($data)) {
            return false;
        }
        mail($data->to, $data->subject, $data->html);
    }


    public function sendOrderEmail($id) {

        $data = new StdClass();
        $orders = new Orders();
   
        $order = $orders->getOrder($id, $type = 'id');


//        $purchases = $this->getPurchases($order['id']);

        ob_start();
        
        extract($order);
        require('theme/email/order.php');
        $html = ob_get_clean();
        $data->to = $order['e_mail'];
        $data->subject = 'Заказ №'.$order['id'];
        $data->html = $html;
        //print_r($data->to);

        $this->email($data);
    }


}
