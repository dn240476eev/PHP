<?php
class CatalogAdmin extends CoreAdmin
{
    public function fetch()
    {
        $products = new Products();
        $request = new Request(); // подключаем модель Запрос
        $categories = new Categories(); // подключаем модель Товары
        $files = new Files();

        $bd = 'images';
        $field[0] = "file_name";
        $field[1] = "product_id";

        if($request->method() == 'POST') {
            $name_operation = $request->post('name_operation');
            $operations = $request->post('operations');

            $products->operatProducts($name_operation, $operations);
            if ($name_operation == 3) {
                $files->delFiles($bd, $field, $operations);
                $files->delBlankFiles($bd, $field, $operations);
            }
        }
        $products_catalog = $products->getProducts();
        $categories_catalog = $categories->getCategories();
        $products->getCsv();
        $xml = $products->getXml2();

        $array_vars = array(
            'name' => 'Продукция',
            'products' => $products_catalog,
            'categories' => $categories_catalog,
            'xml' => $xml,
        );

        return $this->view->render('catalog.html',$array_vars);
    }
}