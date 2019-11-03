<?php

namespace App\Components\About\Add;

use App\AppComponent;


class AboutAddComponent extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php');
    }
}
