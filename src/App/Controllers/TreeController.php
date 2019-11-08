<?php

namespace App\Controllers;

use App\AppController;
use App\Components\Layouts\Layout1\Layout1Component;
use App\Components\Tree\TreeComponent;
use App\Components\Tree\Api\TreeApiComponent;

class TreeController extends AppController
{
    public function indexAction()
    {
        $this->pageTitle = 'Вывод дерева из БД';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(TreeComponent::class)->getTemplate()
            ]
        );
    }

    public function getJsonDataAction()
    {
        // TODO для работы c Api надо дописать движок, поэтому пока так
        echo $this->container->get(TreeApiComponent::class)->run();
    }
}
