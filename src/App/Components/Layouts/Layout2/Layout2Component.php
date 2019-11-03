<?php

namespace App\Components\Layouts\Layout2;

use App\AppComponent;
use App\Components\Layouts\Menu\MenuComponent;

class Layout2Component extends AppComponent
{
    protected $menuComponent;

    public function __construct(MenuComponent $menuComponent)
    {
        $this->menuComponent = $menuComponent;
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', [
            'menu' => $this->menuComponent->getTemplate(),
            'pageTitle' => $data['pageTitle'],
            'content' => $data['content'],
        ]);
    }
}
