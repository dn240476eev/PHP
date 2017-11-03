<?php
if (isset($_GET['route'])) {
    $route = $_GET['route'];
    } else {
        $route = 'main';
    }

if (($route)) {
    switch ($route) {
        case 'page':
            include "html/$route.php";
            // include 'html/page.php';
            break;
        case 'register':
            include "html/$route.php";
            break;
        case 'login':
            include "html/$route.php";
            break;
        case 'product':
            include "html/$route.php";
            break;
        case 'cart':
            include "html/$route.php";
            break;
        case 'wishlist':
            include "html/$route.php";
            break;
        default:
            include 'html/main.php';
            break;
    }
}