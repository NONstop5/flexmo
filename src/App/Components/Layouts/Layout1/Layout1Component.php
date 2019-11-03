<?php

namespace App\Components\Layouts\Layout1;

use App\AppComponent;

class Layout1Component extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data)
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', $data);
    }
}
