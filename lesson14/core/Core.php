<?php
class Core
{
    public $view = '';
    public function __construct()
    {
        require_once 'lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem('theme/html');
        $twig = new Twig_Environment($loader, array(
            'cache'       => 'cache',
            'auto_reload' => true
        ));
        $this->view = $twig;
    }
}