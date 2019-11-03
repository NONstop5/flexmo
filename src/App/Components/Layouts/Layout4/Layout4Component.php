<?php

namespace App\Components\Layouts\Layout4;

use App\AppComponent;

class Layout4Component extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data)
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', $data);
    }
}
