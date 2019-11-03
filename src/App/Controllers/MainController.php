<?php

namespace App\Controllers;

use App\AppController;
use App\Components\Layouts\Layout1\Layout1Component;
use App\Components\Main\Index\MainComponent;

class MainController extends AppController
{
    public function indexAction()
    {
        $this->pageTitle = 'Главная - index';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(MainComponent::class)->getTemplate()
            ]
        );
    }
}
