<?php

namespace Flexmo\Abstracts;

use App\Components\Layouts\HtmlPage\HtmlPageComponent;
use App\Configs\AppConfig;
use Flexmo\Container;

abstract class Controller
{
    /** @var array Массив конфигурации приложения */
    protected $appConfig;
    /** @var string Заголовок страницы */
    protected $pageTitle = '';
    /** @var string Layout страницы */
    protected $layout = '';
    protected $container;

    public function __construct(
        Container $container
    ) {
        $this->appConfig = $container->get(AppConfig::class);
        $this->container = $container;
    }

    public function getComponent(array $data)
    {
        $htmlPage = $this->container->get(HtmlPageComponent::class);

        echo $htmlPage->getTemplate(
            [
                'pageTitle' => $this->pageTitle,
                'layout' => $this->container->get($this->layout)->getTemplate($data)
            ]
        );
    }
}
