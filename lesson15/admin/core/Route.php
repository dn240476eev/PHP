<?php
class Route
{
    public static function run()
    {
        $controllers_dir = 'controllers/';

        $uri = parse_url($_SERVER['REQUEST_URI']);


        $uri_array = array(
            '/admin/' => 'MainAdmin',
            '/admin/categories/' => 'CategoriesAdmin',
            '/admin/category' => 'CategoryAdmin',
            '/admin/products/' => 'CatalogAdmin',
            '/admin/product' => 'ProductAdmin',
            '/admin/pages' => 'PagesAdmin',
            '/admin/page' => 'PageAdmin',
        );
        if($uri['path']) {

            if(file_exists($controllers_dir.$uri_array[$uri['path']] . '.php')) {
                require $controllers_dir.$uri_array[$uri['path']] . '.php'; //controllers/Main.php
                $controller = new $uri_array[$uri['path']](); // new Main();

                if(method_exists($controller,'fetch')) {
                    print $controller->fetch();
                } else {
                    Route::error404();
                }
            } else {
                Route::error404();
            }

        }
    }

    public static function error404()
    {
        //здесь будет 404
    }
}