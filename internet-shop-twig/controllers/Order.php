<?php
class Order extends Core
{
    public function fetch()
    {
        $orders = new Orders();
        $order = new stdClass();
        $purchases = new stdClass();

        $pages = new Pages();
        $all_pages = $pages->getPages();

        $categories = new Categories();
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if (isset($parts[1])) {
            $order = $orders->getOrder($parts[2], 'url');
            $purchases = $orders->getPurchases($order['id']);
        }

        $array_vars = array(
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'order' => $order,
            'purchases' => $purchases,
        );


        if(isset($order['url'])&& empty($parts[3])) {
            return $this->view->render('order.html',$array_vars);
        } else {

            header("http/1.0 404 not found");
            $page = $pages->getPage('404', 'url');
            $array_vars = array(
                'page' => $page,
                'pages' => $all_pages,
                'categories' => $categories_catalog_tree,
            );
            return $this->view->render('page.html', $array_vars);
        }

    }
}