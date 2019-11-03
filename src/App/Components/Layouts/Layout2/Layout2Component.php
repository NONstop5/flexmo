<?php

namespace App\Components\Layouts\Layout2;

use App\AppComponent;

class Layout2Component extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data)
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', $data);
    }
}
