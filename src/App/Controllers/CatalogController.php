<?php

namespace App\Controllers;

use App\AppController;
use App\Components\Catalog\Notebooks\NotebooksComponent;
use App\Components\Catalog\Phones\PhonesComponent;
use App\Components\Catalog\Tablets\TabletsComponent;
use App\Components\Layouts\Layout1\Layout1Component;

class CatalogController extends AppController
{
    public function phonesAction()
    {
        $this->pageTitle = 'Каталог товаров - телефоны';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(PhonesComponent::class)->getTemplate()
            ]
        );
    }

    public function notebooksAction()
    {
        $this->pageTitle = 'Каталог товаров - ноутбуки';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(NotebooksComponent::class)->getTemplate()
            ]
        );
    }

    public function tabletsAction()
    {
        $this->pageTitle = 'Каталог товаров - планшеты';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(TabletsComponent::class)->getTemplate()
            ]
        );
    }
}
