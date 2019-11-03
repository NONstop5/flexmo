<?php

namespace App\Components\About\Index;

use App\AppComponent;
use App\Components\About\Add\AboutAddComponent;
use App\Components\About\Delete\AboutDeleteComponent;
use App\Components\About\Edit\AboutEditComponent;

class AboutComponent extends AppComponent
{
    protected $aboutAddComponent;
    protected $aboutEditComponent;
    protected $aboutDeleteComponent;

    public function __construct(
        AboutAddComponent $aboutAddComponent,
        AboutEditComponent $aboutEditComponent,
        AboutDeleteComponent $aboutDeleteComponent
    ) {
        $this->aboutAddComponent = $aboutAddComponent;
        $this->aboutEditComponent = $aboutEditComponent;
        $this->aboutDeleteComponent = $aboutDeleteComponent;
    }

    public function getTemplate(array $data = [])
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', [
            'aboutAddComponent' => $this->aboutAddComponent->getTemplate(),
            'aboutEditComponent' => $this->aboutEditComponent->getTemplate(),
            'aboutDeleteComponent' => $this->aboutDeleteComponent->getTemplate(),
        ]);
    }
}
