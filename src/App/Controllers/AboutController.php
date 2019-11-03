<?php

namespace App\Controllers;

use App\AppController;
use App\Components\About\Add\AboutAddComponent;
use App\Components\About\Delete\AboutDeleteComponent;
use App\Components\About\Edit\AboutEditComponent;
use App\Components\About\Index\AboutComponent;
use App\Components\Layouts\Layout1\Layout1Component;
use App\Components\Layouts\Layout2\Layout2Component;
use App\Components\Layouts\Layout3\Layout3Component;
use App\Components\Layouts\Layout4\Layout4Component;

class AboutController extends AppController
{
    public function indexAction()
    {
        $this->pageTitle = 'О нас - index';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(AboutComponent::class)->getTemplate()
            ]
        );
    }

    public function addAction()
    {
        $this->pageTitle = 'О нас - add';
        $this->layout = Layout2Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(AboutAddComponent::class)->getTemplate()
            ]
        );
    }

    public function editAction()
    {
        $this->pageTitle = 'О нас - edit';
        $this->layout = Layout3Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(AboutEditComponent::class)->getTemplate()
            ]
        );
    }

    public function deleteAction()
    {
        $this->pageTitle = 'О нас - delete';
        $this->layout = Layout4Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(AboutDeleteComponent::class)->getTemplate()
            ]
        );
    }
}
