<?php
class Page extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();

        $categories = new Categories();
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if (isset($parts[1])) {
            $page = $pages->getPage($parts[1], 'url');
        }
        $array_vars = array(
            'page' => $page,
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'carts' => $cart_catalog,
        );

        if(isset($page['url']) && empty($parts[2])) {
            return $this->view->render('page.html', $array_vars);
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
