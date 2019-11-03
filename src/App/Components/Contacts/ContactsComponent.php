<?php

namespace App\Components\Contacts;

use App\AppComponent;

class ContactsComponent extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php');
    }
}
