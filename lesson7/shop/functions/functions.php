<?php 
header('Content-Type: text/html; charset=utf-8');
require_once 'data/data_categories.php';
require_once 'data/data_pages.php';
require_once 'data/data_products.php';


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
					echo "<a href='/shop/'> $page->name </a>";
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
// 	if(is_array($pages)) {
// 		return $pages[$_GET['id']];
// 	}
// }

//Меню END


//Регистрация

function register($email1, $password1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register']) {
        $email1 = $_POST['email'];
        $password1 = $_POST['password'];
        $user1 = $email1 . "::" . $password1;

        if (!file_exists('users.txt')) {
            file_put_contents('users.txt', '');
        }

        $file = file_get_contents('users.txt');
        $flag = 0;

        if (!empty($file)) {
            $f = fopen('users.txt', 'r');

            if (!empty($email1)) {
                while ($line = fgets($f)) {
                    $tmp[] = $line; // Записали в элемент массива строку из файла
                    $tmp = explode('::', $line); // Разбили строку на два элемента массива логин и пароль

                    if ($tmp[0] == $email1) {
                        $flag = 1;
                    } elseif ($tmp[0] !== $email1 && !empty($password1)) {
                        $flag = 2;
                    }
                }
            }
            fclose($f);
        } elseif (!empty($email1) && !empty($password1)) {
                $flag = 2;
        }

        if ($flag == 1) {
            echo "<p class='not-ok'>Пользователь с таким именем существует. Укажите, пожалуйста, другое имя</p>";
        } elseif ($flag == 2) {
            file_put_contents('users.txt', "$user1\n", FILE_APPEND);
            echo "<p class='ok'>Поздравляем ! Регистрация прошла успешно</p>";
        } else {
            echo "<p class='not-ok'>Заполните, пожалуйста, поля !</p>";
        }

    }

}

//Регистрация END


//Авторизация

function login($email2, $password2)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
            $email2 = $_POST['email'];
            $password2 = $_POST['password'];

            if (file_exists('users.txt')) {
                $file = file_get_contents('users.txt');
            }

            if (!empty($file) || file_exists('users.txt')) {
                $flag = 0;
                $f = fopen('users.txt', 'r');

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

                if ($flag == 1) {
                    echo "<p class='ok'>Добро пожаловать, $email2 !</p>";
                } elseif ($flag == 2) {
                    echo "<p class='not-ok'>Заполните, пожалуйста, поля !</p>";
                } else {
                    echo "<p class='not-ok'>Не верно введен логин или пароль</p>";
                }

            } else {
                echo "<p>Не верно введен логин или пароль</p>";
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

//
//function makeCategories($categories) {
//    if($categories) { // проверка лишней не бывает
//        echo "<ul>";
//        foreach ($categories as $category) {
//            if($category->visible) { //важная проверка, которая позволит выводит только включенные категории на сайте
//                echo "<li><a href='#'>$category->name</a>";
//                if(!empty($category->subcategories)) {
//                    // проверяем есть ли подкатегории и вызываем заново функцию для вывода
//                    echo "<span>></span>";
//                    makeCategories($category->subcategories); // передаем в функцию уже массив обьектов покатегорий
//                }
//                echo "</li>";
//            }
//        }
//        echo "</ul>";
//    }
//}

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