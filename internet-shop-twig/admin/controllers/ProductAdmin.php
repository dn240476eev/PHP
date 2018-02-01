<?php
class ProductAdmin extends CoreAdmin
{
    public function fetch()
    {
        $products = new Products(); // подключаем модель Товары
        $files = new Files();
        $categories = new Categories(); // подключаем модель Товары
        $request = new Request(); // подключаем модель Запрос
        ////////////////////////////
        $product = new stdClass();
        $file = new stdClass();
        $categories_catalog = $categories->getCategories();

        $bd = 'images';
        $field[0] = "file_name";
        $field[1] = "product_id";

        if($request->method() == 'POST' && isset($_POST['save'])) {
                $product->id = $request->post('id', 'integer');
                $product->name = $request->post('name');
                $product->price = $request->post('price', 'integer');
                $product->amount = $request->post('amount', 'integer');
                $product->description = $request->post('description');
                $product->visible = $request->post('visible', 'integer');
                $product->hit = $request->post('hit', 'integer');
//            $product->hit = $request->post('hit','integer');
                $file = $request->files('files');
//            print_r($file);
                $prod_categ = $request->post('parent_id', 'integer');

                if (empty($request->post('url'))) {
                    $product->url = CoreAdmin::translit($request->post('name'));
                } else {
                    $product->url = $request->post('url');
                }

                if ($request->post('id', 'integer')) {
                    $id = $products->updateProduct($request->post('id', 'integer'), $product, $prod_categ);
                    if ($request->files('files')) {
                        $files->updateFiles($id, $bd, $field, $file);
                    }
                } else {
                    //Добавление товара
                    $id = $products->addProduct($product, $prod_categ);
                    if ($request->files('files')) {
                        $files->addFiles($id, $bd, $field, $file);

                    }
                }
                $product = $products->getProduct($id, 'id');

        } elseif ($request->method() == 'POST' && isset($_POST['delete'])) {
            $product->id = $request->post('id');
            $files->delFile($product->id, $bd, $field);
            $files->delBlankFile($product->id, $bd, $field);
            $product = $products->delProduct( $product->id, 'id');
        } elseif ($request->method() == 'POST' && isset($_POST['del_file'])) {
            $product->id = $request->post('id');
            $files->delFile($product->id, $bd, $field);
            $files->delBlankFile($product->id, $bd, $field);
            $product = $products->getProduct($request->get('id','integer'), 'id');
        } elseif ($request->get('id','integer')) {
            $product = $products->getProduct($request->get('id','integer'), 'id');
//            var_dump($product);
        }
print_r($request->get('id','integer'));
        $array_vars = array(
            'product' => $product,
            'categories' => $categories_catalog,
            'file' => $file,
        );

        return $this->view->render('product.html',$array_vars);
    }
}