<?php

namespace App\Components\Catalog\Notebooks;

use App\AppComponent;

class NotebooksComponent extends AppComponent
{
    public function __construct()
    {
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php');
    }
}