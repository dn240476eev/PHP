<?php

class Route
{
    public static function run()
    {
        $controllers_dir = 'controllers/';
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $uri1 = explode('/', $uri['path']);
        $uri2 = array_reverse($uri1);
        $uri_array = array(
            'admin' => 'MainAdmin',
            'products' => 'CatalogAdmin',
            'product' => 'ProductAdmin',
        );

        if($uri1) {
            foreach ($uri2 as $ur)  {
                if(!empty($ur)) {
                    $uri_end = $ur;
                    break;
                }
            }

            if (!file_exists( $controllers_dir . $uri_array[$uri_end] . '.php')) {
                $uri_array = array(
                    'page' => 'PageAdmin',
                );
                $uri_end = 'page';
            }

            require $controllers_dir . $uri_array[$uri_end] . '.php';
            $controller = new $uri_array[$uri_end]();
            if (method_exists($controller, 'fetch')) {
                print $controller->fetch();
            }
        }
    }

    public static function error404()
    {
        //здесь будет 404
    }
}


//class Route
//{
//    public static function run()
//    {
//        $controllers_dir = 'controllers/';
//
//        $uri = parse_url($_SERVER['REQUEST_URI']);
//        print_r($uri['path']);
//
//        $uri1 = explode('/', $uri['path']);
//        print_r($uri1);
//        $uri2 = array_reverse($uri1);
//        print_r($uri2);
//        $uri_array = array(
//            'admin' => 'MainAdmin',
//            'products' => 'CatalogAdmin',
//            'product' => 'ProductAdmin',
//        );
//        $leng = count($uri1);
//        print_r($leng);
//
//        if($uri1) {
//            echo '1111';
//            foreach ($uri2 as $ur)  {
//                if(!empty($ur)) {
//                    $uri_end = $ur;
//                    print_r($uri_end);
//                    break;
//                }
//            }
//
//            if (file_exists( $controllers_dir . $uri_array[$uri_end] . '.php')) {
//                require $controllers_dir . $uri_array[$uri_end] . '.php';
//                $controller = new $uri_array[$uri_end]();
//                if (method_exists($controller, 'fetch')) {
//                    print $controller->fetch();
//                } else {
//                    $uri_array = array(
//                        'page' => 'PageAdmin',
//                    );
//                }
//            } else {
//                $uri_array = array(
//                    'page' => 'PageAdmin',
//                );
//                echo '333333';
//                require $controllers_dir . $uri_array['page'] . '.php';
//                $controller = new $uri_array['page']();
//                if (method_exists($controller, 'fetch')) {
//                    print $controller->fetch();
//                }
//
//            }
//        }
//    }
//
//    public static function error404()
//    {
//        //здесь будет 404
//    }
//}


//class Route
//{
//    public static function run()
//{
//    $controllers_dir = 'controllers/';
//
//    $uri = parse_url($_SERVER['REQUEST_URI']);
//    print_r($uri['path']);
//
//    $uri1 = explode('/', $uri['path']);
//    print_r($uri1);
//
//    $uri_array = array(
//        'admin' => 'MainAdmin',
//        'products' => 'CatalogAdmin',
//        'product' => 'ProductAdmin',
//    );
//    $leng = count($uri1);
//    print_r($leng);
//
//    if($uri1) {
//        echo '1111';
//        $uri_end = $uri1[$leng-2];
//        print_r($uri_end);
//        echo '1111';
//
//        if (file_exists( $controllers_dir . $uri_array[$uri_end] . '.php')) {
//            require $controllers_dir . $uri_array[$uri_end] . '.php';
//            $controller = new $uri_array[$uri_end]();
//            if (method_exists($controller, 'fetch')) {
//                print $controller->fetch();
//            } else {
////                    require $controllers_dir . 'PageAdmin.php';
//            }
//        } else {
//            $uri_array = array(
//                'page' => 'PageAdmin',
//            );
//            echo '333333';
//            require $controllers_dir . $uri_array['page'] . '.php';
//            $controller = new $uri_array['page']();
//            if (method_exists($controller, 'fetch')) {
//                print $controller->fetch();
//            }
//
//        }
//    }
//}
//
//public static function error404()
//{
//    //здесь будет 404
//}
//}


//class Route
//{
//    public static function run()
//    {
//        $controllers_dir = 'controllers/';
//
//        $uri = parse_url($_SERVER['REQUEST_URI']);
//
////        $uri = explode('/', $uri['path']);
////        print_r($uri);
//
//        $uri_array = array(
//            '/admin/' => 'MainAdmin',
//            '/admin/products/' => 'CatalogAdmin',
//            '/admin/product/' => 'ProductAdmin',
//        );
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