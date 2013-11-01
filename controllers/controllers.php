<?php

/**
 * Parent controller class to contain standard functionality.
 * Currently it only initialises a db connection through
 * RedBeanPHP
 * 
 * @author Stephen Flynn
 */
abstract class Controller_Controllers {
    /**
     * Parent constructor.
     * 
     * This needs to be explicitly referenced in child class constructors.
     * ie: parent::__construct();
     * 
     */
    function __construct() {
        require_once(SERVER_ROOT . '/redbean/rb.php');
        R::setup('mysql:host=localhost;dbname=mvcdb', 'mvc_user', 'test_user'); //mysql
        R::freeze(true);
    }

}

?>