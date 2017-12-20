<?php
class MainAdmin extends CoreAdmin
{
    public function fetch()
    {


        $array_vars = array(
            'name' => 'ADMIN',
        );

        return $this->view->render('main.html',$array_vars);
    }
}