<?php
ini_set('display_errors',true);
error_reporting(E_ALL);
require_once ('../config/config.php');
require_once('../models/Database.php');
require_once('../models/Products.php');

$products = new Products();

$root_url = $_SERVER['DOCUMENT_ROOT'];

header("Content-type: text/xml; charset=UTF-8");
print (pack('CCC', 0xef, 0xbb, 0xbf));
// Заголовок
print
"<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE catalog SYSTEM 'feed.xml'>
<catalog date='".date('Y-m-d H:i')."'>
<shop>";
print "<name>Internet shop with TWIG</name>";
print "<company>IMT</company>";
print "<url>".$root_url."</url>";

// Товары
$products_xml =  $products->getXml();
print "<products>";
foreach($products_xml as $product)
{
    $id = $product['id'];
    print "<product id = '$id'>";
    print "<category_name>".htmlspecialchars($product['name_c'])."</category_name>";
    print "<product_name>".htmlspecialchars($product['name'])."</product_name>";
    print "<visible>".$product['visible']."</visible>";
    print "<amount>".$product['amount']."</amount>";
    print "<file_name>".$product['file_name']."</file_name>";
    print "<url>".$root_url.'/product/'.$product['url']."</url>";
    print "<description>".htmlspecialchars(strip_tags($product['description']))."</description>";
    print "</product>";
}
print "</products>";
print "</shop>
</catalog>
";
