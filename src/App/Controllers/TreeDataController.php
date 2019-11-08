<?php

namespace App\Controllers;

use App\AppController;
use App\Components\Layouts\Layout1\Layout1Component;
use App\Components\TreeData\Api\TreeDataApiComponent;
use App\Components\TreeData\TreeDataComponent;
use Symfony\Component\HttpFoundation\Request;

class TreeDataController extends AppController
{
    public function indexAction()
    {
        $this->pageTitle = 'Массив исходных данных для дерева';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(TreeDataComponent::class)->getTemplate()
            ]
        );
    }

    public function saveAction()
    {
        // TODO для работы c Api надо дописать движок, поэтому пока так
        echo $this->container->get(TreeDataApiComponent::class)->run();
    }
}
