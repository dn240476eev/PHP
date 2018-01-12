<?php
class CategoriesAdmin extends CoreAdmin
{
    public function fetch()
    {

        $categories = new Categories();
        $categories_catalog = $categories->getCategories();

//        $files = new Files();
//        $file = new stdClass();


        $array_vars = array(
            'name' => 'Категории',
            'categories' => $categories_catalog,
//            'file' => $file,
        );

        return $this->view->render('categories.html',$array_vars);
    }
}