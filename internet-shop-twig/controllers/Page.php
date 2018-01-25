<?php
class Page extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();
//print_r($all_pages);

        $request = new Request(); // подключаем модель Запрос

        $products = new Products();
        $products_catalog = $products->getProducts();

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
//        print_r($parts);
        if (isset($parts[1])) {
//            $page = $pages->getPage($request->get('url', 'string'), 'url');
//            $page = $pages->getPage($request->get('id','integer'));
//            echo '11111';
//            print_r($page);
            $page = $pages->getPage($parts[1], 'url');

        }
        $array_vars = array(
            'page' => $page,
            'pages' => $all_pages,
            'categories' => $categories_catalog,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
        );

//        $page = $pages->getPage($parts[1], 'url');

//        print_r($page['url']);
        if(isset($page['url'])) {
            return $this->view->render('page.html', $array_vars);
        } else {

            header("http/1.0 404 not found");

            $page = $pages->getPage('404', 'url');
            $array_vars = array(
                'page' => $page,
                'pages' => $all_pages,
                'categories' => $categories_catalog_tree,
            );
            return $this->view->render('page.html', $array_vars);

//            return $this->view->render('page404.html', $array_vars);
        }
    }
}




//<?php
//class Page extends Core
//{
//    public function fetch()
//    {
//$id = 2;
//        $pages = new Pages();
//        $uri = parse_url($_SERVER['REQUEST_URI']);
//        $parts = explode('/', $uri['path']);
//        echo '11111';
//print_r($parts);
//        if (isset($parts[1])) {
//            $page = $pages->getPage($id);
////            $page = $pages->getPage($parts[1], 'url');
//
//        }
//            $array_vars = array(
//            'page' => $page,
//        );
//
////        $page = $pages->getPage($parts[1], 'url');
//
//        echo "<br>";
//        echo "<br>";
//        echo '2222';
//
//        echo "<br>";
//        echo "<br>";
//print_r($page->url);
//        if(isset($page->url)) {
//            return $this->view->render('page.html', $array_vars);
//        } else {
//            header("http/1.0 404 not found");
//            return $this->view->render('page404.html', $array_vars);
//        }
//    }
//}