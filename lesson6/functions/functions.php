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
// 	if(is_array($pages)) {
// 		return $pages[$_GET['id']];
// 	}
// }

//Меню END


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
                echo "<li><a href='#'>$category->name</a>";
                if(!empty($category->subcategories)) {
                    // проверяем есть ли подкатегории и вызываем заново функцию для вывода
                    echo "<span>></span>";
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