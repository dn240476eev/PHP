<?php
class Main extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();
        $products = new Products();

        $filter = array();
        $filter['hit'] = 1;
        $filter['visible'] = 1;
        $filter['amount'] = 1;
        $products_catalog = $products->getProducts($filter);

        $request = new Request();

        $categories = new Categories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        if($request->method() == 'POST' && isset($_POST['cart'])) {
            $id =  $request->post('id', 'integer');
            $amount = 1;
            if (!empty($id) && !empty($amount)) {
                $carts->addCard($id, $amount);
                $URL = $_SERVER['HTTP_REFERER'];
                header ("Location: $URL");
            }
        }

        $array_vars = array(
            'pages' => $all_pages,
            'products' => $products_catalog,
            'categories' => $categories_catalog_tree,
            'carts' => $cart_catalog,
        );

        return $this->view->render('main.html',$array_vars);
    }
}