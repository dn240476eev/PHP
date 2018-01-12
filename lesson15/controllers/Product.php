<?php
class Product extends Core
{
    public function fetch()
    {

        $products = new Products(); // подключаем модель Товары
        $product = new stdClass();

        $pages = new Pages();
        $all_pages = $pages->getPages();
//print_r($all_pages);

        $request = new Request(); // подключаем модель Запрос

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if (isset($parts[1])) {
            $product = $products->getProduct($request->get('url', 'string'), 'url');
        }
        $array_vars = array(
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'product' => $product,
        );

//        $page = $pages->getPage($parts[1], 'url');

        return $this->view->render('product.html',$array_vars);
    }
}