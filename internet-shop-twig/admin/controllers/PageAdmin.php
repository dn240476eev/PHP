<?php
class PageAdmin extends CoreAdmin
{
    public function fetch()
    {
        $pages = new Pages();
        $request = new Request(); // подключаем модель Запрос

        $page = new stdClass();

        if($request->method() == 'POST' && isset($_POST['save'])) {
            $page->id = $request->post('id', 'integer');
            $page->name = $request->post('name');
            $page->sort = $request->post('sort', 'integer');
            $page->description = $request->post('description');
            $page->visible = $request->post('visible','integer');
            if(empty($request->post('url'))) {
                $page->url = CoreAdmin::translit($request->post('name'));
            } else {
                $page->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                $id = $pages->updatePage($request->post('id','integer'),$page);

            } else {
                //Добавление
                $id = $pages->addPage($page);
            }

            $page = $pages->getPage($id, 'id');

        } elseif ($request->method() == 'POST' && isset($_POST['delete'])) {
            $page->id = $request->post('id');
            $page = $pages->delPage( $page->id, 'id');
        } elseif ($request->get('id','integer')) {
            $page = $pages->getPage($request->get('id','integer'), 'id');
        }

        $array_vars = array(
            'page' => $page,
        );

        return $this->view->render('page.html',$array_vars);
    }
}