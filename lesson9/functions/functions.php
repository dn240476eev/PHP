<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'data/data_categories.php';
require_once 'data/data_pages.php';
require_once 'data/data_products.php';


//Обработка формы ввода ссылки

// Транслит:

function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, array_flip($converter));
}

function validLinkProd($link_prod) {
    $link_prod = $_POST['link_prod'];
    // переводим в транслит
    $link_prod = rus2translit($link_prod);
    // в нижний регистр
    $link_prod = strtolower($link_prod);
    // заменям все ненужное нам на "-"
//    $link_prod = preg_replace('~[^-а-я0-9_]+~u', '-', $link_prod);
    $link_prod = preg_replace('/^[-|\/]{1,}|[-|\/]{1,}$/u', '', $link_prod);
    // удаляем начальные и конечные '-'
    $link_prod = trim($link_prod, "-");
    return $link_prod;
}

// Транслит END


//Обработка формы ввода ссылки END


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

function postArray ($id, $name, $email, $password, $password1) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $post_array = array(trim(strip_tags($id)), trim(strip_tags($name)), trim(strip_tags($email)), trim(strip_tags($password)), trim(strip_tags($password1)));
    return $post_array;
}

function register($id, $name, $email, $password, $password1) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $error_array = array();
    $flag = 0;

    // не менее 4-х латинских букв и допустимы цифры
    $match_id = preg_match('/^((([0-9]){1,})?(([a-z]){1,})(([0-9]){1,})?(([a-z]){1,})(([0-9]){1,})?(([a-z]){1,})(([0-9]){1,})?(([a-z]){1,})(([0-9]){1,})?)+$/ui', $id);
    // только кирилические буквы, символ дефиз, без цифр
    $match_name = preg_match('/^[а-я-?]+$/ui', $name);
    // только латинские буквы, знаки .-
    $match_email = preg_match("/^([a-z\-?\.?]+@[a-z\-?\.?]+\.[a-z]{2,6}+)$/ui", $email);
    // только латинские буквы цифры, знаки .-
//    $match_email = preg_match("/^([a-z0-9\-?\.?]+@[a-z0-9\-?\.?]+\.[a-z]{2,6}+)$/ui", $email);
    //не менее 4-х символов из латинских букв, цифр, знаков /-*?
    $match_password = preg_match('/^[a-z0-9-?\/?\*?\??]{4,16}+$/ui', $password);
    $match_password1 = preg_match('/^[a-z0-9-?\/?\*?\??]{4,16}+$/ui', $password1);


    if (file_exists('files/users.txt')) {
        $file = file_get_contents('files/users.txt');
    }

    if ($match_id && $match_name && $match_email) {
        if ($match_password && $match_password1) {
            if ($password === $password1) {
                $f = fopen('files/users.txt', 'a+');
                if (!empty($file)) {
                    while ($line = fgets($f)) {
                        $tmp[] = $line; // Записали в элемент массива строку из файла
                        $tmp = explode('::', $line); // Разбили строку на элементы массива
                        if ($tmp[0] == $id) {
                            $error_array[0] = 'Пользователь с таким логином существует. Укажите, пожалуйста, другой логин';
                            break;
                        } elseif ($tmp[1] !== $email && !empty($password)) {
                            $flag = 1;
                        }
                    }
                } else $flag = 1;

            } else $error_array[] = 'Пароли не совпадают, повторите ввод паролей';
        }
    }

    if (!$match_id) {
        $error_array[] = 'Введите корректный логин';
    }
    if (!$match_name) {
        $error_array[] = 'Введите корректное имя';
    }
    if (!$match_email) {
        $error_array[] = 'Е-mail адрес не существует, введите правильный e-mail';
    }
    if (!$match_password || !$match_password1) {
        $error_array[] = 'Введите корректный пароль';
    }

//print_r($error_array);

    if ($flag == 1) {
        $pass_hash = password_hash(trim(strip_tags($password)), PASSWORD_DEFAULT);
        $user = trim(strip_tags($id)) . "::" . trim(strip_tags($name)) . "::" . trim(strip_tags($email)) . "::" . $pass_hash;
        file_put_contents('files/users.txt', "$user\n", FILE_APPEND);
        echo "<p class='ok'>Поздравляем ! Регистрация прошла успешно</p>";
        echo "<p>Для входа на сайт просим Вас <a href=?route=login>авторизоваться</a></p>";
    } else {
        echo "<p class='not-ok'>Пожалуйста, исправьте следующие ошибки:</p>";
        foreach ($error_array as $error) {
            echo "<p>- $error</p>";
        }

    }
}

//Регистрация END


//Авторизация

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
    if(login($_POST['id'], $_POST['password'])) {
        $name = login($_POST['id'], $_POST['password']);
        setcookie("name", $name, time() + 3600 * 24 * 30, '/', '', false, true);
    } else {
        if(isset($_COOKIE['name'])) setcookie("name", "", time() - 3600);
    }
}

function login($id, $password) {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $name = null;
        if (file_exists('files/users.txt')) {
            $file = file_get_contents('files/users.txt');
        }

        if (!empty($file) || file_exists('files/users.txt')) {
            $f = fopen('files/users.txt', 'r');

            if (!empty($id) && !empty($password)) {
                while ($line = fgets($f)) {
                    $tmp[] = $line; // Записали в элемент массива строку из файла
                    $tmp = explode('::', $line); // Разбили строку на два элемента массива логин и пароль
                    if ($id == trim($tmp[0]) && password_verify($password, trim($tmp[3]))) {
                        $name = trim($tmp[1]);
                    }
                }
            } else $name = 0;
            fclose($f);
        }
        return $name;
}

function outputLogin($id, $password) {
    $name = login($id, $password);
        if (!empty($name)) {
            echo "<p class='ok'>Добро пожаловать, $name !</p>";
        } elseif (isset($name)) {
            echo "<p class='not-ok'>Заполните, пожалуйста, поля !</p>";
        } else {
            echo "<p class='not-ok'>Не верно введен логин или пароль</p>";
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

//
//
// ДОБАВЛЕНИЕ товара в корзину COOKIE

// передали данные

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart'])) {
    if (!empty($_POST['id']) && !empty($_POST['amount'])) {
        addCard(trim(strip_tags($_POST['id'])), trim(strip_tags($_POST['amount'])));
    }
    unset($_SESSION['order_id']);
}

// направили куки
function addCard($id, $amount) {
    if(isset($_COOKIE['cart'])){
         $cart = unserialize($_COOKIE['cart']);
         $cart[$id] += $amount;
    } else {
        $cart[$id] = $amount;
    }
    setcookie('cart', serialize($cart),time()+3600*24*30, '/', '', false, true);
    $URL = $_SERVER['HTTP_REFERER'];
    header ("Location: $URL");
}


//ОБНОВЛЕНИЕ КОРЗИНЫ

// передали данные

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['refresh'])) {
    $cart_item = array();
    foreach ($_POST['cart_item'] as $id => $amount) {
        $id = trim(strip_tags($id));
        $amount = trim(strip_tags($amount));
        $cart_item[$id] = $amount;
    }
        foreach ($cart_item as $id => $amount) {
            if (!empty($id) && !empty($amount)) {
                refreshCard($cart_item);
            }
        }
    $URL = $_SERVER['HTTP_REFERER'];
    header ("Location: $URL");
}


// направили куки

function refreshCard($cart_item) {
    if(isset($_COOKIE['cart'])){
        $cart = unserialize($_COOKIE['cart']);
        $cart = array_replace($cart,  $cart_item);
    } else {
        $cart = $cart_item;
    }
    setcookie('cart', serialize($cart),time()+3600*24*30, '/', '', false, true);
}


// Вывод корзины с суммой в корзине

function getCard($products) {

        $cart_items['summ_price'] = 0;
        $cart_items['summ_prod'] = 0;

    if(isset($_COOKIE['cart'])) {
        $cart = unserialize($_COOKIE['cart']);
        foreach ($cart as $id => $amount) {
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


//Запись корзины в файл


function buy($products) {
    $cart_item = $_POST['cart_item'];

    $flag = 0;
    $order = rand(1,9999);
    $date = date('d-m-Y');
    $_SESSION['order_id']= "Ваш заказ № $order от $date.";

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

            (isset($_COOKIE['name'])) ? $user = $_COOKIE['name'] : $user = uniqid('', true);;

            $user1 = $user . "::" . $order . "::" . date('d m Y H:i:s') . '::' . $id . "::" . $name . "::" . $price . "::" . $amount . "::" . $summ_price;
            file_put_contents("$part/cart.txt", "$user1\n", FILE_APPEND);
            $flag = 1;
        }
    }

//        return $flag;
}


//Удаление COOKIE для корзины по факту записи в файл

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy'])) {
    if(isset($_COOKIE['cart'])) {
        setcookie("cart", '', time() - 3600, '/', '', false, true );
        $URL = $_SERVER['HTTP_REFERER'];
        header ("Location: $URL");
    }
}


//print_r($_SERVER);


//Список желаний - избранное

//передали данные

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['favor'])) {
    if (!empty($_POST['id']) ) {
            addFavor(trim(strip_tags($_POST['id'])));
    }
}

// направили куки
function addFavor($id) {
    if(isset($_COOKIE['favor'])){
        $favor = unserialize($_COOKIE['favor']);
    }
    $favor[$id] = $id;
    setcookie("favor", serialize($favor), time()+3600*24*30, '/', '', false, true );
    $URL = $_SERVER['HTTP_REFERER'];
    header ("Location: $URL");
}

//print_r(unserialize($_COOKIE['favor']));

//Товар в избранном

function getFavorProduct($products) {
    if(isset($_COOKIE['favor'])) {
        $favor = unserialize($_COOKIE['favor']);

        $favor_items['summ_prod'] = 0;
        foreach ($favor as $id) {
            $product = getProduct($products, $id); // объект
            $favor_items['products'][] = $product;
            $favor_items['summ_prod'] = count($favor);
        }
//        print_r($favor_items);
        return $favor_items;
    } else return 0;
}

//Товар в избранном END