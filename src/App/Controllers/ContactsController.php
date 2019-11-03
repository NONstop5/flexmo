<?php

namespace App\Controllers;

use App\AppController;
use App\Components\Contacts\ContactsComponent;
use App\Components\Layouts\Layout1\Layout1Component;

class ContactsController extends AppController
{
    public function indexAction()
    {
        $this->pageTitle = 'Контакты - index';
        $this->layout = Layout1Component::class;

        $this->getComponent(
            [
                'pageTitle' => $this->pageTitle,
                'content' => $this->container->get(ContactsComponent::class)->getTemplate()
            ]
        );
    }
}
