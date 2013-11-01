<?php

/**
 * Pages Controller.
 * 
 * This controller is called when people link to a specific page using
 * the page parameter coupled with a page slug.
 * It inherits a constructor from Controller_Controllers.
 * {@inheritdoc }
 * 
 * @author Stephen Flynn
 * 
 */
class Controller_Pages extends Controller_Controllers {

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

        if (isset($getVars['slug'])) {
            $article = R::findOne('pages', 'slug= ?', array($getVars['slug']));
            $data['title'] = $article->title;
            $data['content'] = $article->content;
        }

        $template = $this->twig->loadTemplate('pages.html.twig');
        echo $template->render(array('data' => $data));
    }

}

?>
