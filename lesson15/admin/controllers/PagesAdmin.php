<?php
class PagesAdmin extends CoreAdmin
{
    public function fetch()
    {
        $pages = new Pages();
        ///////////////////////////////////////
        $all_pages = $pages->getPages();

        $array_vars = array(
            'pages' => $all_pages,
            'name' => 'Страницы',
        );

        return $this->view->render('pages.html',$array_vars);

    }
}