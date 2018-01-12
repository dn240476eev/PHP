<?php
class CatalogAdmin extends CoreAdmin
{
    public function fetch()
    {

        $products = new Products();
        $categories = new Categories(); // подключаем модель Товары

        $products_catalog = $products->getProducts();
        $categories_catalog = $categories->getCategories();

        $array_vars = array(
            'name' => 'Продукция',
            'products' => $products_catalog,
            'categories' => $categories_catalog,
        );

        return $this->view->render('catalog.html',$array_vars);
    }
}