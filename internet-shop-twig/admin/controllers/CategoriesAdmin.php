<?php
class CategoriesAdmin extends CoreAdmin
{
    public function fetch()
    {
        $categories = new Categories();
        $request = new Request(); // подключаем модель Запрос
        $files = new Files();

        $bd = 'categories';
        $field[0] = 'image';
        $field[1] = 'id';

        if($request->method() == 'POST') {
            $name_operation = $request->post('name_operation');
            $operations = $request->post('operations');
            if ($name_operation == 3) {
                $files->delFiles($bd, $field, $operations);
            }
            $categories->operatCategories($name_operation, $operations);
        }

        $categories_catalog = $categories->getCategories();

        $array_vars = array(
            'name' => 'Категории',
            'categories' => $categories_catalog,
        );

        return $this->view->render('categories.html',$array_vars);
    }
}