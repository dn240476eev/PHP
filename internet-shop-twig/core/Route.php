<?php
class Route
{
    public static function run()
    {
        $models_dir = 'models/';
        $controllers_dir = 'controllers/';

        $uri = parse_url($_SERVER['REQUEST_URI']);

        $parts = explode('/', $uri['path']);

        $uri_array = array(
            '' => 'Main',
            'category' => 'Category',
//            'catalog' => 'Catalog',
            'product' => 'Product',
            'cart' => 'Cart',
            'order' => 'Order',
        );
//var_dump($uri_array[$parts[1]]);

        if(!empty($parts)) {
            if (isset($uri_array[$parts[1]])) {
                //Это служебная ссылка
                if(file_exists($controllers_dir.$uri_array[$parts[1]] . '.php')) {
                    require $controllers_dir . $uri_array[$parts[1]] . '.php'; //controllers/Main.php
                    $controller = new $uri_array[$parts[1]](); // new Main();

                    if (method_exists($controller, 'fetch')) {
                        print $controller->fetch();
                    } else {
                        Route::error404();
                    }
                }
            } else {
                if (file_exists($controllers_dir . 'Page.php')) {
                    require $controllers_dir . 'Page.php';
                    $controller = new Page();

                    if (method_exists($controller, 'fetch')) {
                        print $controller->fetch();
                    } else {
                        Route::error404();
                    }
                }
            }
        }
    }

    public static function error404()
    {
        //здесь будет 404
    }
}
















//
//
//<?php
//class Route
//{
//    public static function run()
//    {
//        $controllers_dir = 'controllers/';
//
//        $uri = parse_url($_SERVER['REQUEST_URI']);
//
//        $uri_array = array(
//            '/' => 'Main',
//
//            '/category' => 'Category',
//            '/product' => 'Product',
//            'cart' => 'Cart',
//            'order' => 'Order',
//            '/page' => 'Page',
//        );
//
//        if($uri['path']) {
//
//            if(file_exists($controllers_dir.$uri_array[$uri['path']] . '.php')) {
//                require $controllers_dir.$uri_array[$uri['path']] . '.php'; //controllers/Main.php
//                $controller = new $uri_array[$uri['path']](); // new Main();
//
//                if(method_exists($controller,'fetch')) {
//                    print $controller->fetch();
//                } else {
//                    Route::error404();
//                }
//            } else {
//                Route::error404();
//            }
//
//        }
//    }
//
//    public static function error404()
//    {
//        //здесь будет 404
//    }
//}