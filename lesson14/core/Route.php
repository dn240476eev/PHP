<?php
class Route
{
    public static function run()
    {
        $models_dir = 'models/';
        $controllers_dir = 'controllers/';

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $uri1 = explode('/', $uri['path']);
        $uri2 = array_reverse($uri1);

        $uri_array = array(
            '' => 'Main',
            'catalog' => 'Catalog',
        );

        if($uri1) {
            if($uri1[1]!=='') {
                foreach ($uri2 as $ur) {
                    if (!empty($ur)) {
                        $uri_end = $ur;
                        break;
                    }
                }
            } else {
                $uri_end = '';
            }

            if (!file_exists( $controllers_dir . $uri_array[$uri_end] . '.php')) {
                $uri_array = array(
                    'page' => 'Page',
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


//
//class Route
//{
//    public static function run()
//    {
//        $models_dir = 'models/';
//        $controllers_dir = 'controllers/';
//
//        $uri = parse_url($_SERVER['REQUEST_URI']);
//        $uri1 = explode('/', $uri['path']);
//        print_r($uri1);
//
//        $uri2 = array_reverse($uri1);
//        print_r($uri2);
//
//
//        $uri_array = array(
//            '' => 'Main',
//            'catalog' => 'Catalog',
//        );
//        $leng = count($uri1);
//        print_r($leng);
//
//        if($uri1) {
//            if($uri1[1]!=='') {
//                echo '151';
//                foreach ($uri2 as $ur) {
//                    if (!empty($ur)) {
//                        $uri_end = $ur;
//                        print_r($uri_end);
//                        break;
//                    }
//                }
//            } else {
//                $uri_end = '';
//                echo '222';
//            }
//
//            if (file_exists( $controllers_dir . $uri_array[$uri_end] . '.php')) {
//                require $controllers_dir . $uri_array[$uri_end] . '.php';
//                $controller = new $uri_array[$uri_end]();
//                if (method_exists($controller, 'fetch')) {
//                    print $controller->fetch();
//                } else {
//                    $uri_array = array(
//                        'page' => 'Page',
//                    );
//                }
//            } else {
//                $uri_array = array(
//                    'page' => 'Page',
//                );
//                echo '333333';
//                require $controllers_dir . $uri_array['page'] . '.php';
//                $controller = new $uri_array['page']();
//                if (method_exists($controller, 'fetch')) {
//                    echo '4444';
//
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
//    {
//        $models_dir = 'models/';
//        $controllers_dir = 'controllers/';
//
//        $uri = parse_url($_SERVER['REQUEST_URI']);
//
//
//        $uri_array = array(
//            '/' => 'Main',
//            'catalog' => 'Catalog',
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