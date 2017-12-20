<?php
class Page extends Core
{

    public function fetch()
    {
        $controllers_dir = 'theme/html/';
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $uri1 = explode('/', $uri['path']);
        $uri2 = array_reverse($uri1);

        foreach ($uri2 as $ur)  {
            if(!empty($ur)) {
                $uri_end = $ur;
                break;
            }
        }

        $array_vars = array(
            'name' => $uri_end,
            'error' => '404',
        );

        if (file_exists( $controllers_dir . $uri_end . '.html')) {
            $file = $uri_end;
        } else $file = '404';

        $res = $this->view->render($file.'.html', $array_vars);
        return $res;
    }

}