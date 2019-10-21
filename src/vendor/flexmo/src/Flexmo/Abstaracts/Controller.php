<?php

namespace Flexmo\Abstracts;

use Flexmo\Renderer;

abstract class Controller
{
    /** @var array Текущий маршрут */
    protected $route = [];

    /** @var string Текущий вид */
    protected $view;
    protected $pageTitle = '';
    protected $layoutName = DEFAULT_LAYOUT;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['view'];
    }

    public function render()
    {
        $viewFile = VIEW_PATH . $this->route['controller'] . DIRECTORY_SEPARATOR . $this->view . '.php';
        $layoutFile = LAYOUTS_PATH . $this->layoutName . '.php';

        $content = Renderer::getTemplate($viewFile, []);
        $resultHtml = Renderer::getTemplate($layoutFile, [
            'pageTitle' => $this->pageTitle,
            'content' => $content
        ]);
        echo $resultHtml;
    }

    public function indexAction()
    {
        $this->render();
    }
}
