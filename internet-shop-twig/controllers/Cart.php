<?php
class Cart extends Core
{
    public function fetch()
    {
        $carts = new Carts();

        $orders = new Orders();
        $order = new stdClass();
        $user = new stdClass();

        $notify = new Notify();

        $pages = new Pages();
        $all_pages = $pages->getPages();

        $request = new Request();

        $categories = new Categories();
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $error = NULL;

        if($request->method() == 'POST' && isset($_POST['refresh'])) {
            $cart_item = array();
            foreach ($_POST['cart_item'] as $id => $amount) {
                $id = trim(strip_tags($id));
                $amount = trim(strip_tags($amount));
                $cart_item[$id] = $amount;
            }
            foreach ($cart_item as $id => $amount) {
                if (!empty($id) && !empty($amount)) {
                    $carts->refreshCard($cart_item);
                }
            }
            $URL = $_SERVER['HTTP_REFERER'];
            header ("Location: $URL");

        }

        if($request->method() == 'POST' && isset($_POST['del'])) {
            if(isset($_POST['operations'])) {
                $operations = $_POST['operations'];
                $carts->delCartProd($operations);
            $URL = $_SERVER['HTTP_REFERER'];
            header ("Location: $URL");
            }
        }

        $cart_catalog = $carts->getCard();
        if($request->method() == 'POST' && isset($_POST['buy'])) {
            $user->first_name = $request->post('first_name');
            $user->last_name = $request->post('last_name');
            $user->e_mail = $request->post('e-mail');
            $user->phone = $request->post('phone');
            if(!empty($user->first_name) && !empty($user->last_name) && !empty($user->e_mail)  && !empty($user->phone)) {
                $order->user_id = $orders->addUser($user);
                $order->status_id = 1;
                $order->total_cost = $cart_catalog['summ_price'];
                $date = date("c");
                $url = $user->e_mail.$date;
                $order->url = md5($url);
                $id = $orders->addOrder($order, $user);
                $orders->addPurchases($id, $cart_catalog['products']);
              
//                $notify->sendOrderEmail($id);
                $carts->delCart();

                $URL = "../order/$order->url";
                header ("Location: $URL");
            } else $error = $orders->formError($order);

        }

        $array_vars = array(
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'carts' => $cart_catalog,
            'error' => $error,
        );

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if ($parts[1] = 'cart' && empty($parts[2])) {
            return $this->view->render('cart.html',$array_vars);
        } else {
            header("http/1.0 404 not found");
            $page = $pages->getPage('404', 'url');
            $array_vars = array(
                'page' => $page,
                'pages' => $all_pages,
                'categories' => $categories_catalog_tree,
                'carts' => $cart_catalog,
            );
            return $this->view->render('page.html', $array_vars);
        }

    }
}