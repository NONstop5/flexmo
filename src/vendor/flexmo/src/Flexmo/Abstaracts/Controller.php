<?php


namespace Flexmo\Abstracts;


abstract class Controller
{
    public $route = [];
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        bdump($route);
//        $this->view = $route['action'];
//
//        include_once VIEWS_PATH . $route['controller'] . '/' . $this->view . '.php';
    }

    public function indexAction()
    {
        echo get_called_class() . '<br>';
        echo __FUNCTION__ . '<br>';
    }
}
