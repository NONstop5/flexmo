<?php


namespace Flexmo\Abstracts;


use App\Configs\AppConfig;
use Flexmo\Renderer;

abstract class Controller
{
    /** @var array Текущий маршрут */
    protected $route = [];
    /** @var string Заголовок страницы */
    protected $pageTitle = '';
    /** @var string Путь к Layouts */
    protected $layoutsPath;
    /** @var string Layout страницы */
    protected $layoutName;
    /** @var string Путь до текущего view */
    protected $viewPath;
    /** @var string Текущий вид */
    protected $viewName;
    /** @var array Массив переменных для layout */
    protected $layoutVariables = [];
    /** @var array Массив переменных для view */
    protected $viewVariables = [];
    /** @var array Массив конфигурации приложения */
    protected $appConfig;

    public function __construct(array $route, array $appConfig)
    {
        $this->appConfig = $appConfig;
        $this->route = $route;

        $this->layoutName = $this->layoutName ?: $this->appConfig[AppConfig::DEFAULT_LAYOUT_NAME];
        $this->viewPath = $this->appConfig[AppConfig::VIEW_PATH] . $this->route['controller'] . DIRECTORY_SEPARATOR;
        $this->viewName = $route['view'];
    }

    public function render(array $templateData)
    {
//        $content = Renderer::getTemplate($viewFile, $this->viewVariables);
//        $resultHtml = Renderer::getTemplate($layoutFile, array_merge(
//            $this->layoutVariables,
//            ['pageTitle' => $this->pageTitle],
//            ['content' => $content]
//        ));
        echo Renderer::getTemplate($template, $data);
    }

    public function indexAction()
    {
        $layoutFile = $this->layoutsPath . $this->layoutName . '.php';
        $this->render([
            'mainHtml' => [
                'Layouts/defaultLayout' => [
                    'header',
                    'view' => ['asd' => 'asd']
                ]
            ]
        ]);
        $viewFile = $this->viewPath . $this->viewName . '.php';

        $this->render($layoutFile, $viewFile);
    }
}
