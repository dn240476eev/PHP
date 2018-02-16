<?php
class Category extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();

        $products = new Products();
        $products_catalog = new stdClass();

        $request = new Request();

        $categories = new Categories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $category = new stdClass();


        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if (isset($parts[2])) {
            $category = $categories->getCategory($parts[2], 'url');
        }
        if (isset($category['url'])) {
            $category_id = $categories->GetCategoriesId($category['id']);
            $filter['cat_id'] = $category_id;
            $filter['visible'] = 1;
            $filter['amount'] = 1;
            $products_catalog = $products->getProducts($filter);
        }

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
            'category' => $category,
            'carts' => $cart_catalog,
        );

        if(isset($category['url']) && empty($parts[3])) {
            return $this->view->render('category.html',$array_vars);
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
