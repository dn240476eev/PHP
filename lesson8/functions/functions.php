<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'data/data_categories.php';
require_once 'data/data_pages.php';
require_once 'data/data_products.php';

//Вывод последней посещенной страницы, времени и даты

setcookie("last[path]", $_SERVER['DOCUMENT_ROOT'], time()+3600*24*30, '/', '', false, true);
setcookie("last[page]", $_SERVER['REQUEST_URI'], time()+3600*24*30, '/', '', false, true);
setcookie("last[date]", date('d m Y H:i:s'), time()+3600*24*30, '/', '', false, true);

function lastPage() {
    $last_page = array();
    if(isset($_COOKIE['last'])) {
        foreach ($_COOKIE['last'] as $last) {
            $last_page[] = $last;
        }
        return $last_page;
    }
}
//print_r(lastPage());


//Меню

function getPages($data_pages) {
    if(file_exists('data/data_pages.php')) {
        return unserialize($data_pages);
    }
}

$pages = getPages($data_pages);

function makeMenu($pages) {
    if(is_array($pages)) {
        foreach ($pages as $page) {
            if ($page->visible && $page->menu_id == 1) {
                if ($page->id == 1) {
                    echo "<a href='/'> $page->name </a>";
                } else {
                    echo "<a href=?route=page&id=$page->id> $page->name </a>";
                }
            }
        }
    }
}

function getPage($pages, $id) {
    if(is_array($pages)) {
        return $pages[$id];
    }
}

// function getPage($pages) {
//     if(is_array($pages)) {
//         return $pages[$_GET['id']];
//     }
// }

//Меню END


//Регистрация

function register($email1, $password1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register']) {
        $email1 = $_POST['email'];
        $password1 = $_POST['password'];
        $user1 = $email1 . "::" . $password1;

        if (!file_exists('files/users.txt')) {
            file_put_contents('files/users.txt', '');
        }

        if (file_exists('files/users.txt')) {
            $file = file_get_contents('files/users.txt');
        }
        $flag = 0;

        if (!empty($file)) {
            $f = fopen('files/users.txt', 'r');

            if (!empty($email1)) {
                if (filter_var($email1, FILTER_VALIDATE_EMAIL)) {
//                if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email1)) {
                    while ($line = fgets($f)) {
                        $tmp[] = $line; // Записали в элемент массива строку из файла
                        $tmp = explode('::', $line); // Разбили строку на два элемента массива логин и пароль

                        if ($tmp[0] == $email1) {
                            $flag = 1;
                        } elseif ($tmp[0] !== $email1 && !empty($password1)) {
                            $flag = 2;
                        }
                    }
                } else $flag = 3;
            }
            fclose($f);
        } elseif (!empty($email1) && !empty($password1)) {
                $flag = 2;
        }

        if ($flag == 1) {
            echo "<p class='not-ok'>Пользователь с таким именем существует. Укажите, пожалуйста, другое имя</p>";
        } elseif ($flag == 2) {
            file_put_contents('files/users.txt', "$user1\n", FILE_APPEND);
            echo "<p class='ok'>Поздравляем ! Регистрация прошла успешно</p>";
        } elseif ($flag == 3) {
            echo "<p class='not-ok'>Е-mail адрес не существует, введите праильный e-mail</p>";
        } else {
            echo "<p class='not-ok'>Заполните, пожалуйста, поля !</p>";
        }
    }

}

//Регистрация END


//Авторизация

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
    if(login($_POST['email'], $_POST['password']) == 1) {
        $email = trim(strip_tags($_POST['email']));
        if (!empty($email)) {
            setcookie("name", $email, time() + 3600 * 24 * 30, '/', '', false, true);
        }
    } else {
        if(isset($_COOKIE['name'])) setcookie("name", "", time() - 3600, '/', '', false, true);
    }
}

function login($email2, $password2) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
        $email2 = $_POST['email'];
        $password2 = $_POST['password'];

        if (file_exists('files/users.txt')) {
            $file = file_get_contents('files/users.txt');
        }

        $flag = 0;
        if (!empty($file) || file_exists('files/users.txt')) {
            $f = fopen('files/users.txt', 'r');

            if (!empty($email2) && !empty($password2)) {
                while ($line = fgets($f)) {
                    $tmp[] = $line; // Записали в элемент массива строку из файла
                    $tmp = explode('::', $line); // Разбили строку на два элемента массива логин и пароль
                    if ($email2 == trim($tmp[0]) && $password2 == trim($tmp[1])) {
                        $flag = 1;
                    }
                }
            } else $flag = 2;
            fclose($f);
        }

        return $flag;
    }
}

function outputLogin($email2, $password2) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
        $email2 = $_POST['email'];
        $password2 = $_POST['password'];
        if (login($email2, $password2) == 1) {
            echo "<p class='ok'>Добро пожаловать, $email2 !</p>";
        } elseif (login($email2, $password2) == 2) {
            echo "<p class='not-ok'>Заполните, пожалуйста, поля !</p>";
        } else {
            echo "<p class='not-ok'>Не верно введен логин или пароль</p>";
        }
    }
}

//Авторизация END


//Дерево категорий

function getCategories($data_categories) {
    if(file_exists('data/data_categories.php')) {
        return unserialize($data_categories);
    }
}

$categories = getCategories($data_categories);

function GetCategoriesTree($categories,$parent_id=0) {
    $results=array();
    if ($categories) {
        foreach ($categories as $category) {
            if ($category->parent_id==$parent_id) {
                if ($category->id!=$parent_id) {
                    $subcategories = GetCategoriesTree($categories,$category->id);
                    if(!empty($subcategories))
                        $category->subcategories = $subcategories ;
                };
                $results[]=$category;
                unset($category);
            }
        }
    }
    return $results;
}

$categories = GetCategoriesTree($categories);

function makeCategories($categories) {
    if($categories) { // проверка лишней не бывает
        echo "<ul>";
        foreach ($categories as $category) {
            if($category->visible) { //важная проверка, которая позволит выводит только включенные категории на сайте
                echo "<li><input type=\"checkbox\" name=\"but\" id=\"$category->id\">
                <label for=\"$category->id\" class=\"label\"><a href='#'>$category->name</a>";
                if(!empty($category->subcategories)) {
                    // проверяем есть ли подкатегории и вызываем заново функцию для вывода
                    echo "<span>></span></label>";
                    makeCategories($category->subcategories); // передаем в функцию уже массив обьектов покатегорий
                }
                echo "</li>";
            }
        }
        echo "</ul>";
    }
}

//Дерево категорий END


//Товары

function getProducts($data_products) {
    if(file_exists('data/data_products.php')) {
        return unserialize($data_products);
    }
}

$products = getProducts($data_products);


//Товары END



//Товар

function getProduct($products, $id) {
    if (is_array($products)) {
        return $products[$id];
    }
}

//Товар END



// ДОБАВЛЕНИЕ товара в корзину COOKIE

// передали данные

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart'])) {
    if (!empty($_POST['id']) && !empty($_POST['amount'])) {
        addCard(trim(strip_tags($_POST['id'])), trim(strip_tags($_POST['amount'])));
    }
}

// направили куки
function addCard($id, $amount) {
    if (isset($_COOKIE['cart'])) {
        foreach ($_COOKIE['cart'] as $id1 => $amount1) {
            if ($id1 == $id) $amount = $amount + $amount1; // ув-ние кол-ва товаров к корзине
        }
    }
    setcookie("cart[$id]", $amount, time()+3600*24*30, '/', '', false, true );
    $URL = $_SERVER['HTTP_REFERER'];
    header ("Location: $URL");
}


//ОБНОВЛЕНИЕ КОРЗИНЫ

// передали данные

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['refresh']) || isset($_POST['buy']) ) {
    foreach ($_POST['cart_item'] as $id => $amount) {
        if (!empty($id) && !empty($amount)) {
            refreshCard(trim(strip_tags($id)), trim(strip_tags($amount)));
        }
    }
}

// направили куки

function refreshCard($id, $amount) {
    setcookie("cart[$id]", $amount, time()+3600*24*30, '/', '', false, true );
    $URL = $_SERVER['HTTP_REFERER'];
    header ("Location: $URL");
}

// Вывод корзины с суммой в корзине

function getCard($products) {

        $cart_items['summ_price'] = 0;
        $cart_items['summ_prod'] = 0;

    if(isset($_COOKIE['cart'])) {
        foreach ($_COOKIE['cart'] as $id => $amount) {
            $product = getProduct($products, $id); // объект
            $product->cart_amount = $amount; // создаем поле объекта
            $cart_items['products'][] = $product;
            $cart_items['summ_price'] += $product->variant->price * $amount;
            $cart_items['summ_prod'] += $amount;

        }
//        print_r($cart_items);
        return $cart_items;
    } else return 0;
}


//// Добавление товара в корзину COOKIE

//// Вывод корзины с суммой в корзине
//
//function getCard($products) {
//    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart'])) {
//        if (!empty($_POST['id']) && !empty($_POST['amount'])) {
//            $id = trim(strip_tags($_POST['id']));
//            $amount = trim(strip_tags($_POST['amount']));
//            if (isset($_COOKIE['cart']) && !empty($id) && !empty($amount)) {
//                foreach ($_COOKIE['cart'] as $id1 => $amount1) {
//                    if ($id1 == $id) {
//                        $amount = $amount + $amount1; // ув-ние кол-ва товаров к корзине
//                    }
//                }
//            }
//            setcookie("cart[$id]", $amount, time()+3600*24*30, '/');
//        }
//    }
//        $cart_items['summ_price'] = 0;
//        $cart_items['summ_prod'] = 0;
//
//    if(isset($_COOKIE['cart'])) {
//        foreach ($_COOKIE['cart'] as $id => $amount) {
//            $product = getProduct($products, $id); // объект
//            $product->cart_amount = $amount; // создаем поле объекта
//            $cart_items['products'][] = $product;
//            $cart_items['summ_price'] += $product->variant->price * $amount;
//            $cart_items['summ_prod'] += $amount;
//
//        }
//        return $cart_items;
//    } else return 0;
//
//}


//Запись корзины в файл

function buy($products) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy'])) {
        $cart_item = $_POST['cart_item'];
        $flag = 0;

        $user = uniqid('', true);

        $part = 'files';
        $dir = $part . '/';
        if (!is_dir($dir)) mkdir($part, 0777);

        fopen("$part/cart.txt", 'a+');

        foreach ($cart_item as $id => $amount) {
            if (!empty($id) && !empty($amount)) {
                $product = getProduct($products, $id); // объект
                $name = $product->name;
                $price = $product->variant->price;
                $summ_price = $product->variant->price * $amount;

                if (isset($_COOKIE['name'])) $user = $_COOKIE['name'];

                $user1 = $user . "::" . date('d m Y H:i:s') . '::' . $id . "::" . $name . "::" . $price . "::" . $amount . "::" . $summ_price;
                file_put_contents("$part/cart.txt", "$user1\n", FILE_APPEND);
                $flag = 1;
            }
        }

//        return $flag;
    }
}

//Удаление COOKIE для корзины по факту записи в файл

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy'])) {
    if(isset($_COOKIE['cart'])) {
        foreach ($_COOKIE['cart'] as $id => $amount) {
            setcookie("cart[$id]", $amount, time() - 3600, '/', '', false, true );
        }
    }
}

//print_r($_SERVER);


//Списиок желаний - избранное

//передали данные

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['favor'])) {
    if (!empty($_POST['id']) ) {
            addFavor(trim(strip_tags($_POST['id'])));
    }
}

// направили куки
function addFavor($id) {
    setcookie("favor[$id]", $id, time()+3600*24*30, '/', '', false, true );
    $URL = $_SERVER['HTTP_REFERER'];
    header ("Location: $URL");
}

//Товар в избранном

function getFavorProduct($products) {
    if(isset($_COOKIE['favor'])) {
        $favor_items['summ_prod'] = 0;
        foreach ($_COOKIE['favor'] as $id) {
            $product = getProduct($products, $id); // объект
            $favor_items['products'][] = $product;
            $favor_items['summ_prod'] = count($_COOKIE['favor']);

        }
//        print_r($favor_items);
        return $favor_items;
    } else return 0;
}

//Товар в избранном END


//Список желаний - избранное

////передали данные
//
//if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['favor'])) {
//    if (!empty($_POST['id']) ) {
//        addFavor(trim(strip_tags($_POST['id'])));
//    }
//}
//
//// направили куки
//function addFavor($id) {
//    $fav[$id] = $id;
//    setcookie("favor", serialize($fav), time()+3600*24*30, '/', '', false, true );
//    $URL = $_SERVER['HTTP_REFERER'];
//    header ("Location: $URL");
//}
//
////Товар в избранном
//
//function getFavorProduct($products) {
//    if(isset($_COOKIE['favor'])) {
//        print_r($_COOKIE['favor']);
//        $get_cook = unserialize($_COOKIE['favor']);
//        print_r($get_cook);
//        $favor_items['summ_prod'] = 0;
//        foreach ($get_cook as $id) {
//            $product = getProduct($products, $id); // объект
//            $favor_items['products'][] = $product;
////            $favor_items['summ_prod'] = count($_COOKIE['favor']);
//            $favor_items['summ_prod'] = count($_COOKIE['favor']);
//
//        }
////        print_r($favor_items);
//        return $favor_items;
//    } else return 0;
//}
//
////Товар в избранном END
