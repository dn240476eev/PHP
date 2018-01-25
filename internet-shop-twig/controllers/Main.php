<?php
class Main extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();
//print_r($all_pages);
        $products = new Products();
        $products_catalog = $products->getProducts();

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();
//        print_r($categories_catalog_tree);
//        $categories_make_catalog = $categories->makeCategories($categories_catalog_tree);
//        print_r($categories_make_catalog);

        $array_vars = array(
            'pages' => $all_pages,
            'products' => $products_catalog,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
//            'categories_make_catalog' => $categories_make_catalog,
        );

        return $this->view->render('main.html',$array_vars);
    }
}