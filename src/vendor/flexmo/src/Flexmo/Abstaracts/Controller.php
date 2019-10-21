<?php

namespace Flexmo\Abstracts;

use Flexmo\Renderer;

abstract class Controller
{
    /** @var array Текущий маршрут */
    protected $route = [];

    /** @var string Заголовок страницы */
    protected $pageTitle = '';

    /** @var string Layout страницы */
    protected $layoutName = DEFAULT_LAYOUT;

    /** @var string Текущий вид */
    protected $view;

    /** @var array Массив переменных для layout */
    protected $layoutVariables = [];

    /** @var array Массив переменных для view */
    protected $viewVariables = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['view'];
    }

    public function render()
    {
        $viewFile = VIEW_PATH . $this->route['controller'] . DIRECTORY_SEPARATOR . $this->view . '.php';
        $layoutFile = LAYOUTS_PATH . $this->layoutName . '.php';

        $content = Renderer::getTemplate($viewFile, $this->viewVariables);
        $resultHtml = Renderer::getTemplate($layoutFile, array_merge(
            $this->layoutVariables,
            ['pageTitle' => $this->pageTitle],
            ['content' => $content]
        ));
        echo $resultHtml;
    }

    public function indexAction()
    {
        $this->render();
    }
}
