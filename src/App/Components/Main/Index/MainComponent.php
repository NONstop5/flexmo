<?php

namespace App\Components\Main\Index;

use App\AppComponent;

class MainComponent extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php');
    }
}
