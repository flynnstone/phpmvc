<?php

/**
 * Index Controller.
 * 
 * This is the controller class that generates a page when no
 * specific controller is specified.  It people got to www.site.com.
 * It inherits a constructor from Controller_Controllers.
 * {@inheritdoc }
 * 
 * @author Stephen Flynn
 * 
 */
class Controller_Index extends Controller_Controllers {

    public function __construct() {

        parent::__construct();
        $this->loader = new Twig_Loader_Filesystem(TEMPLATE_DIR);
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => SERVER_ROOT . "/cache",
            'debug' => true
        ));
    }

    /**
     * Main rendering function.
     * 
     * This function accepts an associative array containing the URL parameters.  
     * It queries the database using these parameters and calls the twig method
     * loadtemplate and renders it. 
     * 
     * @param array|mixed $getVars URL Parameters.
     */
    public function main(array $getVars) {
        $pages = R::findAll('pages', ' ORDER BY id');

        foreach ($pages as $key => $page) {
            if ($page->slug != 'index') {
                $slugs[] = $page->slug;
            } else {
                $data['title'] = $page->title;
                $data['content'] = $page->content;
            }
        }

        $template = $this->twig->loadTemplate('index.html.twig');
        echo $template->render(array('data' => $data, 'slugs' => $slugs));

    }

}

?>
