<?php

namespace App\Components\Layouts\Menu;

use App\AppComponent;

class MenuComponent extends AppComponent
{
    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', $data);
    }
}
