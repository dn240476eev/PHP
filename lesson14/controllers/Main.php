<?php
class Main extends Core
{
    public function fetch()
    {


        $array_vars = array(
            'name' => 'hello',
        );

        return $this->view->render('main.html',$array_vars);
    }
}