<?php

namespace App\Components\Catalog\Tablets;

use App\AppComponent;

class TabletsComponent extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php');
    }
}
