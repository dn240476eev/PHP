<?php
class ProductAdmin extends CoreAdmin
{
    public function fetch()
    {
        $products = new Products();
        $request = new Request();
        ////////////////////////////
        $product = new stdClass();

        if($request->method() == 'POST') {
            $product->name = $request->post('name');
            $product->description = $request->post('description');
            $product->visible = $request->post('visible','integer');
            $product->image = $request->post('image');
            if(empty($request->post('url'))) {
                $product->url = CoreAdmin::translit($request->post('name'));
            } else {
                $product->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                $id = $products->updateProduct($request->post('id','integer'),$product);

            } else {
                //Добавление товара
                $id = $products->addProduct($product);
            }

            $product = $products->getProduct($id);
        }

        $array_vars = array(
            'product' => $product,
        );

        return $this->view->render('product.html',$array_vars);
    }
}