<?php
class Category extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();

        $products = new Products();
        $products_catalog = $products->getProducts();

        $request = new Request(); // подключаем модель Запрос

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $category = new stdClass();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
//        print_r($parts[2]);
        if (isset($parts[2])) {
//            $category = $categories->getCategory($request->get('url', 'string'), 'url');
            $category = $categories->getCategory($parts[2], 'url');
        }
//        print_r($category['id']);
        $category_id = $categories->GetCategoriesId($category['id']);
//        print_r($category_id);

        $array_vars = array(
            'pages' => $all_pages,
            'products' => $products_catalog,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'category' => $category_id,
        );

        return $this->view->render('category.html',$array_vars);
    }
}
