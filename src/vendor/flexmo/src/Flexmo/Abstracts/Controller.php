<?php

namespace Flexmo\Abstracts;

use App\Components\Layouts\HtmlPage\HtmlPageComponent;
use DI\Container;

abstract class Controller
{
    /** @var string Заголовок страницы */
    protected $pageTitle = '';
    /** @var string Layout страницы */
    protected $layout = '';
    protected $container;

    public function __construct(Container $container)
    {
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
