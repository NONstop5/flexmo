<?php

namespace App\Components\Layouts\HtmlPage;

use App\AppComponent;
use Flexmo\Container;

class HtmlPageComponent extends AppComponent
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getTemplate(array $data)
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', $data);
    }
}
