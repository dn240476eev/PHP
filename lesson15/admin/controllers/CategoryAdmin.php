<?php
class CategoryAdmin extends CoreAdmin
{
    public function fetch()
    {
        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();

        $files = new Files();
        $request = new Request(); // подключаем модель Запрос
        ////////////////////////////
        $category = new stdClass();
        $file = new stdClass();

        if($request->method() == 'POST') {
            $category->id = $request->post('id');
            $category->name = $request->post('name');
            $category->visible = $request->post('visible','integer');
            $category->parent_id = $request->post('parent_id');
//            $category->image = $request->post('files');
            $category->description = $request->post('description');
//            $category->image = $request->post('files');
            $file = $request->files('files');
            $bd = 'categories';
            $field = 'image';

            if(empty($request->post('url'))) {
                $category->url = CoreAdmin::translit($request->post('name'));
            } else {
                $category->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                $id = $categories->updateCategory($request->post('id','integer'),$category);
                if ($request->files('files')) {
                    $file = $files->updateFile($id, $bd, $field, $file);
                }
            } else {
                //Добавление товара
                $id = $categories->addCategory($category);
                if ($request->files('files')) {
                    $file = $files->addFile($id, $bd, $field, $file);

                }
            }

            $category = $categories->getCategory($id, 'id');

        } elseif ($request->get('id','integer')) {
            $category = $categories->getCategory($request->get('id','integer'), 'id');
//            var_dump($category);
        }

        $array_vars = array(
            'category' => $category,
            'categories' => $categories_catalog,
            'file' => $file,
        );

        return $this->view->render('category.html',$array_vars);
    }
}