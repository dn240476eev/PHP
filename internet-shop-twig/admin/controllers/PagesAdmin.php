<?php
class PagesAdmin extends CoreAdmin
{
    public function fetch()
    {
        $pages = new Pages();
        $request = new Request(); // подключаем модель Запрос
        ///////////////////////////////////////
        if($request->method() == 'POST') {
            $name_operation = $request->post('name_operation');
            $operations = $request->post('operations');
            $pages->operatPages($name_operation, $operations);
        }
        print_r($name_operation);
        $all_pages = $pages->getPages();

        $array_vars = array(
            'pages' => $all_pages,
            'name' => 'Страницы',
        );

        return $this->view->render('pages.html',$array_vars);

    }
}